<?php
namespace TenJava\Controllers\Api;

use Config;
use Input;
use Response;
use TenJava\Contest\JudgeClaimsInterface;
use TenJava\Controllers\Abstracts\BaseController;
use Illuminate\Filesystem\Filesystem;
use TenJava\Models\Application;
use TenJava\Models\ParticipantCommit;

class ApiController extends BaseController {
    /**
     * @var JudgeClaimsInterface
     */
    private $claims;

    /**
     * @param JudgeClaimsInterface $claims
     */
    public function __construct(JudgeClaimsInterface $claims) {
        parent::__construct();
        $this->claims = $claims;
    }

    public function getParticipants() {
        // This is a public endpoint that gives a list of applicants with no info
        // other than GitHub usernames.

        if (Input::has("repos")) {
            return Application::with(['timeEntry','commits'])->has("timeEntry", ">", "0")->where('judge', false)->get();
        }

        if (Input::has("streams")) {
            return Response::json(Application::where("judge", false)->lists("twitch_username", "gh_username"));
        }
        return Response::json(Application::where("judge", false)->lists("gh_username"));
    }

    public function didParticipantParticipate($repo) {
        return ParticipantCommit::where("repo", $repo)->get();
    }


    public function getConfirmedParticipants($confirmed) {
        // This is a public endpoint that gives a list of applicants with no info
        // other than GitHub usernames.
        if ($confirmed) {
            if (Input::has("times")) {
                $apps = Application::with('timeEntry')->has("timeEntry", ">", "0")->where('judge', false)->get();
                $finalList = [];
                foreach ($apps as $app) {
                    /** @var $app \TenJava\Models\Application */
                    if ($app->timeEntry->t1) {
                        $finalList[] = $app->gh_username . "-t1";
                    }
                    if ($app->timeEntry->t2) {
                        $finalList[] = $app->gh_username . "-t2";
                    }
                    if ($app->timeEntry->t3) {
                        $finalList[] = $app->gh_username . "-t3";
                    }
                }
                return Response::json($finalList);
            } else {
                return Response::json(Application::with('timeEntry')->has("timeEntry", ">", "0")->where('judge', false)->lists("gh_username"));
            }
        } else {
            return Response::json(Application::with('timeEntry')->has("timeEntry", "=", "0")->where('judge', false)->lists("gh_username"));
        }
    }

    public function getPoints() {
        $jsonResponse = Response::make((new FileSystem())->get(public_path("/assets/data.json")), 200, array('Content-Type' => 'application/json'));
        return $jsonResponse;
    }

    public function getActiveJudges() {
        return Response::json($this->auth->getAllJudges());
    }

    public function getJudgeClaims() {
        return Response::json($this->claims->getAllJudgesWithClaims());
    }

    public function getSessionData() {
        var_dump(Input::all());
        echo(json_encode(["is_admin" => $this->auth->isAdmin(), "is_staff" => $this->auth->isStaff()]));
        var_dump($_GET);
        die();
    }

} 