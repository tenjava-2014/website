<?php
namespace TenJava\Controllers\Api;

use Config;
use Input;
use Response;
use TenJava\Controllers\Abstracts\BaseController;
use Illuminate\Filesystem\Filesystem;
use TenJava\Models\Application;

class ApiController extends BaseController {

    public function getParticipants() {
        // This is a public endpoint that gives a list of applicants with no info
        // other than GitHub usernames.
        return Response::json(Application::where("judge", false)->lists("gh_username"));
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
        return Response::json(Config::get("user-access.present.Judges"));
    }

    public function getSessionData() {
        var_dump(Input::all());
        var_dump($_GET);
        die();
        //return Response::json(Session::all());
    }

} 