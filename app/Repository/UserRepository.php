<?php namespace TenJava\Repository;

use Config;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use TenJava\Staff;
use TenJava\User;

class UserRepository implements UserRepositoryInterface {

    public function getGitHubUser(SocialiteUser $socialiteUser) {
        return $this->byGitHubID($socialiteUser);
    }

    private function byGitHubID(SocialiteUser $socialiteUser) {
        return $this->firstOrCreate(User::query()->where('gh_id', $socialiteUser->getId()), $socialiteUser);
    }

    public function firstOrCreate(Builder $builder, SocialiteUser $socialiteUser) {
        $user = $builder->first();
        return ($user !== null) ? $this->update($user, $socialiteUser) : $this->create($socialiteUser);
    }

    public function update(User $user, SocialiteUser $socialiteUser) {
        $user->username = $socialiteUser->getNickname();
        $user->name = $socialiteUser->getName();
        $user->email = $socialiteUser->getEmail();
        $user->emails = json_encode($this->getGitHubEmails($socialiteUser));
        $user->avatar = $socialiteUser->getAvatar();
        $user->save();
        return $user;
    }

    private function getGitHubEmails(SocialiteUser $socialiteUser) {
        $emails = $socialiteUser->user['emails'];
        $real_emails = [];
        foreach ($emails as $email) {
            array_push($real_emails, $email['email']);
        }
        return $real_emails;
    }

    public function create(SocialiteUser $socialiteUser) {
        $user = new User();
        $user->gh_id = $socialiteUser->getId();
        $this->update($user, $socialiteUser);
        return $user;
    }

    /**
     * @return array
     */
    public function getStaffMembers() {
        $teamMembers = [];
        $this->addIfEntries($teamMembers, 'Organizers', Staff::organizer()->get()->lists('username'));
        $this->addIfEntries($teamMembers, 'Web Team', Staff::webTeam()->get()->lists('username'));
        $this->addIfEntries($teamMembers, 'Judges', Staff::judge()->get()->lists('username'));
        $this->addIfEntries($teamMembers, 'Sponsors', Config::get('user-access.present.Sponsors'));
        return $teamMembers;
    }

    private function addIfEntries(array &$addTo, $key, array $adding) {
        if (count($adding) < 1) return;
        $addTo[$key] = $adding;
    }
}
