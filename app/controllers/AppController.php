<?php

class AppController extends BaseController {

    public function applyJudge() {
        return Redirect::to("/oauth/confirm")->with('intent', 'judge');
    }

    public function applyParticipant() {
        return Redirect::to("/oauth/confirm")->with('intent', 'participant');
    }

    public function listApps() {
        $appData = Session::get("application_data");
        if ($appData['username'] !== "lol768" && $appData['username'] !== "jkcclemens" ) {
            return Response::json("unauthorised");
        } else {
            return View::make("app_list")->with(array("apps" => Application::paginate(15)));
        }
    }

    public function processApplication() {
        $appData = Session::get("application_data");
        if (Application::where("gh_username", $appData['username'])->first() != null) {
            return View::make("dupe_app");
        }
        if (!$appData['judge']) {
            $validator = Validator::make(
                array(
                     'dbo' => Input::get("dbo"),
                ),
                array(
                     'dbo' => 'required|max:255',
                )
            );
            if ($validator->fails()) {
                return View::make("bad_app")->with(array("messages" => $validator->messages()));
            }
            $app = new Application();
            $app->gh_username = $appData['username'];
            $app->github_email = json_encode($appData['emails']);
            $app->judge = false;
            $app->dbo_username = Input::get("dbo");
            $app->save();
            return View::make("thanks");
        } else {
            $validator = Validator::make(
                array(
                     'dbo' => Input::get("dbo"),
                     'mc' => Input::get("mcign"),
                     'gmail' => Input::get("gdocs"),
                     'irc'   => Input::get("irc")
                ),
                array(
                     'dbo' => 'required|max:255',
                     'mc' => 'required|max:16',
                     'irc' => 'required|max:255',
                     'gmail' => 'required|email|max:255'
                )
            );
            if ($validator->fails()) {
                return View::make("bad_app")->with(array("messages" => $validator->messages()));
            }
            $app = new Application();
            $app->gh_username = $appData['username'];
            $app->github_email = json_encode($appData['emails']);
            $app->judge = true;
            $app->dbo_username = Input::get("dbo");
            $app->irc_username = Input::get("irc");
            $app->mc_username = Input::get("mcign");
            $app->gmail = Input::get("gdocs");
            $app->save();
            return View::make("thanks");
        }
    }

} 