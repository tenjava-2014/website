<?php

use Illuminate\Filesystem\Filesystem;

class ApiController extends BaseController {

    public function getParticipants() {
        // This is a public endpoint that gives a list of applicants with no info
        // other than GitHub usernames.
        return Response::json(Application::where("judge", false)->lists("gh_username"));
    }

    public function getPoints() {
        $jsonResponse = Response::make((new FileSystem())->get(public_path("/assets/data.json")), 200, array('Content-Type' => 'application/json'));
        return $jsonResponse;
    }

    public function getSessionData() {
        var_dump(Input::all());
        var_dump($_GET);
        die();
        //return Response::json(Session::all());
    }

} 