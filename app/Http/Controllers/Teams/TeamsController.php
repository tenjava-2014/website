<?php namespace TenJava\Http\Controllers\Teams;

use Auth;
use Config;
use Markdown;
use Redirect;
use Response;
use Symfony\Component\DomCrawler\Crawler;
use TenJava\Http\Controllers\Abstracts\BaseController;
use TenJava\Http\Requests\CreateTeamRequest;
use TenJava\Http\Requests\DeleteTeamRequest;
use TenJava\Http\Requests\InviteToTeamRequest;
use TenJava\Http\Requests\UpdateTeamRequest;
use TenJava\Invite;
use TenJava\Request;
use TenJava\Team;
use TenJava\User;
use View;

class TeamsController extends BaseController {

    public function acceptInvite(Invite $invite) {
        if ($invite->user_id !== Auth::id()) {
            return Redirect::back()->withErrors(['That invitation is not for you.']);
        }
        if ($invite->team->members->count() >= 5) {
            return Redirect::back()->withErrors(['That team has hit the maximum amount of members.']);
        }
        $user = $invite->user;
        $user->setTeam($invite->team);
        $invite->delete();
        return Redirect::back();
    }

    public function acceptRequest(Request $request) {
        if ($request->team->leader_id !== Auth::id()) {
            return Redirect::back()->withErrors(['You cannot accept a request for a team you are not the leader of.']);
        }
        $user = $request->user;
        $user->setTeam($request->team);
        $request->delete();
        return Redirect::back();
    }

    public function createTeam(CreateTeamRequest $request) {
        $team = new Team();
        $team->leader_id = Auth::id();
        $team->name = $request->name;
        $team->description = $request->description;
        $team->general_rules = $request->general_rules;
        $team->prize_rules = $request->prize_rules;
        $team->miscellaneous_rules = $request->miscellaneous_rules ? : null;
        $team->save();
        /** @var $user \TenJava\User */
        $user = Auth::user();
        $user->setTeam($team);
        return Redirect::to('/teams');
    }

    public function deleteTeam(DeleteTeamRequest $request) {
        /** @var $user User */
        $user = Auth::user();
        $user->team->delete();
        return Redirect::to('/teams');
    }

    public function inviteToTeam(InviteToTeamRequest $request) {
        $invite = new Invite();
        $invite->user_id = User::whereUsername($request->invitee)->first()->id;
        $invite->team_id = Auth::user()->team_id;
        $invite->save();
        return Redirect::back();
    }

    public function leaveTeam() {
        /** @var $user User */
        $user = Auth::user();
        if ($user->team->leader_id === $user->id) {
            return Redirect::back()->withErrors(['You cannot leave a team you are the leader of.']);
        }
        $user->team_id = null;
        $user->save();
        return Redirect::back();
    }

    public function randomTeamName($amount = 1) {
        // lol768: BLAH BLAH SRP
        if ($amount > 100) $amount = 10;
        $first = Config::get('team-names.first');
        $second = Config::get('team-names.second');
        shuffle($first);
        shuffle($second);
        $names = [];
        for ($i = 0; $i < $amount; $i++) {
            if (count($first) < 1 || count($second) < 1) break;
            $names[] = array_pop($first) . ' ' . array_pop($second);
        }
        return Response::json($names);
    }

    public function removeFromTeam(User $user) {
        if ($user->team->leader_id !== Auth::id()) {
            return Redirect::back()->withErrors(['You are not the team leader.']);
        }
        $user->team_id = null;
        $user->save();
        return Redirect::back();
    }

    public function removeRequest(Request $request) {
        if ($request->team->leader_id !== Auth::id()) {
            return Redirect::back()->withErrors(['You cannot remove a request for a team you are not the leader of.']);
        }
        $request->delete();
        return Redirect::back();
    }

    public function requestToJoin(Team $team) {
        /** @var User $user */
        $user = Auth::user();
        if ($user->team_id !== null) {
            return Redirect::back()->withErrors(['You cannot request to join a team if you are in a team.']);
        }
        $request = new Request();
        $request->user_id = $user->id;
        $request->team_id = $team->id;
        $request->save();
        return Redirect::back();
    }

    public function showCreateTeamPage() {
        return $this->createUpdateTeamPage(true);
    }

    private function createUpdateTeamPage($creating) {
        $this->setPageTitle(($creating ? 'Create a' : 'Update') . ' team');
        $this->setActive(($creating ? 'create ' : 'update') . ' team');
        return View::make('teams.forms.create')->with('creating', $creating);
    }

    public function showTeamPage(Team $team) {
        $isLoggedIn = Auth::check();
        $isLeader = $isLoggedIn && Auth::id() === $team->leader_id;
        $isMember = $isLeader || ($isLoggedIn && Auth::user()->team_id === $team->id);
        return View::make('teams.team')
            ->with('team', $team)
            ->with('miscellaneous_rules', $this->markdownize($team->miscellaneous_rules))
            ->with('description', $this->markdownize($team->description))
            ->with('general_rules', $this->markdownize($team->general_rules))
            ->with('prize_rules', $this->markdownize($team->prize_rules))
            ->with('isLeader', $isLeader)
            ->with('isMember', $isMember)
            ->with('invite', Invite::whereTeamId($team->id)->whereUserId(Auth::id())->first())
            ->with('request', $isLoggedIn ? Request::whereTeamId($team->id)->whereUserId(Auth::id())->first() : false);
    }

    private function markdownize($markdown) {
        if ($markdown === null) return null;
        $html = Markdown::render($markdown);
        /**
         * @var $crawler Crawler
         */
        $crawler = new Crawler($html);
        $crawler = $crawler->children()->children()->reduce(function (Crawler $node, $i) {
            return $node->filter('img')->count() < 1;
        });
        $html = '';
        foreach ($crawler as $domElement) {
            $html .= $domElement->ownerDocument->saveHTML($domElement);
        }
        return $html;
    }

    public function showTeamsPage() {
        $this->setPageTitle('Teams');
        $this->setActive('teams');
        $isLoggedIn = Auth::check();
        $invites = $isLoggedIn ? Auth::user()->invites : false;
        /** @var Team $team */
        $team = $isLoggedIn ? Auth::user()->team : false;
        return View::make('teams.dashboard')
            ->with('allTeams', Team::all())
            ->with('invites', $invites)
            ->with('team', $team);
    }

    public function showUpdateTeamPage() {
        $team = Auth::user()->team;
        if ($team === null) return Redirect::back();
        return $this->createUpdateTeamPage(false)->with('team', $team);
    }

    public function uninvite(Invite $invite) {
        if ($invite->team->leader_id !== Auth::id()) {
            return Redirect::back()->withErrors(['You are not the team leader.']);
        }
        $invite->delete();
        return Redirect::back();
    }

    public function updateTeam(UpdateTeamRequest $request) {
        /** @var Team $team */
        $team = Auth::user()->team;
        $team->update($request->all());
        $team->miscellaneous_rules = $request->miscellaneous_rules ? : null;
        $team->save();
        return Redirect::route('team', [$team]);
    }

}
