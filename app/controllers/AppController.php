<?php

class AppController extends BaseController {

    public function applyJudge() {
        return Redirect::to("/oauth/confirm")->with('intent', 'judge');
    }

    public function applyParticipant() {
        return Redirect::to("/oauth/confirm")->with('intent', 'participant');
    }

    public function processApplication() {
        $appData = Session::get("application_data");

        if (!$appData['judge']) {
            $app = new Application();
            $app->gh_username = $appData['username'];
            $app->github_email = json_encode($appData['emails']);
            $app->judge = false;
            $app->dbo_username = Input::get("dbo");
            $app->save();
            return View::make("thanks");
        } else {
            echo "NYI";
        }
    }

} 