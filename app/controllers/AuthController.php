<?php

class AuthController extends BaseController {
    public function loginWithGitHub() {
        // get data from input
        Session::reflash();
        $code = Input::get('code');

        $githubService = OAuth::consumer('GitHub');

        if (!empty($code)) {

            // This was a callback request from github, get the token
            $token = $githubService->requestAccessToken($code);

            // Send a request with it
            $result = json_decode($githubService->request('user'), true);

            //Var_dump
            //display whole array().
            if (!Session::has("intent")) {
                die("No intent :(");
            }
            if (Session::get("intent") === "judge") {
                return View::make("judge", array("user" => $result['login']));
            } else {
                return View::make("participant", array("user" => $result['login']));
            }

        } // if not ask for permission first
        else {
            $url = $githubService->getAuthorizationUri();

            // return to github login url
            return Redirect::to((string)$url);
        }
    }

} 