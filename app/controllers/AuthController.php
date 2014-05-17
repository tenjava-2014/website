<?php

class AuthController extends BaseController {
    public function loginWithGitHub() {
        // get data from input
        $code = Input::get('code');

        $githubService = OAuth::consumer('GitHub');

        if (!empty($code)) {

            // This was a callback request from github, get the token
            $token = $githubService->requestAccessToken($code);

            // Send a request with it
            $result = json_decode($githubService->request('user'), true);

            $message = 'Your unique GitHub user id is: ' . $result['id'] . ' and your name is ' . $result['login'];
            echo $message . "<br/>";

            //Var_dump
            //display whole array().
            dd($result);

        } // if not ask for permission first
        else {
            $url = $githubService->getAuthorizationUri();

            // return to github login url
            return Redirect::to((string)$url);
        }
    }

} 