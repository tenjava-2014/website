<?php

use OAuth\Common\Http\Exception\TokenResponseException;

class AuthController extends BaseController {
    public function loginWithGitHub() {
        // get data from input
        Session::reflash();
        $code = Input::get('code');

        $githubService = OAuth::consumer('GitHub');

        if (!empty($code)) {

            // This was a callback request from github, get the token
            try {
                $token = $githubService->requestAccessToken($code);
            } catch (TokenResponseException $e) {
                return Redirect::to("/");
            }

            // Send a request with it
            $result = json_decode($githubService->request('user'), true);
            $emails = json_decode($githubService->request("user/emails"), true);
            //Var_dump
            //display whole array().
            if (!Session::has("intent")) {
                die("No intent :(");
            }
            $githubUsername = $result['login'];
            $intent = Session::get("intent");

            Session::put("application_data", array("username" => $githubUsername, "emails" => array("public" => $result['email'], "others" => $emails), "judge" => ($intent === "judge")));

            if ($intent === "judge") {
                return View::make("judge", array("user" => $githubUsername));
            } else {
                return View::make("participant", array("user" => $githubUsername));
            }

        } // if not ask for permission first
        else {
            $url = $githubService->getAuthorizationUri();

            // return to github login url
            return Redirect::to((string)$url);
        }
    }

} 