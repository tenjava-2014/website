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
        $githubUsername = $appData['username'];

        /**
         * These users can see contact information if the applicant chose to disclose it to us.
         */
        $authorisedUsers = array(
            "lol768", // organiser
            "jkcclemens", // organiser
            "hawkfalcon" // organiser
        );

        /**
         * These users (typically judges) can see IRC/twitch/DBO usernames but cannot see emails.
         */
        $limitedUsers = array(
            "CaptainBern", // judge
            "tenjava" // testing purposes
        );

        if (!in_array($githubUsername, $authorisedUsers + $limitedUsers)) {
            if (!$githubUsername) {
                return Redirect::to("/oauth/confirm")->with('intent', 'admin');
            } else {
                return Response::json("No auth.");
            }
        } else {
            $viewData = array(
                "append" => array(),
                "apps" => null,
                "fullAccess" => false
            );

            if (in_array($githubUsername, $authorisedUsers)) {
                $viewData["fullAccess"] = true;
            }

            if (Input::has("judges")) {
                $viewData['apps'] = Application::where('judge', true)->paginate(5);
                $viewData['append'] = array("judges" => "1");
            } else if (Input::has("normal")) {
                $viewData['apps'] = Application::where('judge', false)->paginate(5);
                $viewData['append'] = array("normal" => "1");
            } else {
                $viewData['apps'] = Application::paginate(5);
            }

            return View::make("app_list")->with($viewData);
        }
    }

    public function noEmail() {
        if (Input::has("undo")) {
            Session::forget("no-email");
        } else {
            Session::put("no-email", true);
        }
        return Redirect::to("/");
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
                     'twitch' => Input::get("twitch")
                ),
                array(
                     'dbo' => 'required|max:255',
                     'twitch' => 'max:255',
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
            if (!Input::has("twitch")) {
                $app->twitch_username = "USER_REJECTED"; //field not nullable so this will have to do.
            } else {
                $app->twitch_username = Input::get("twitch");
            }
            $app->save();
            $this->addUserRepo($appData['username']);
            return View::make("thanks")->with(array("repo" => $appData['username']));
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

    public function addUserRepo($username) {
        $client = new \Github\Client();
        $client->authenticate("tenjava", Config::get("gh-data.pass"), \GitHub\Client::AUTH_HTTP_PASSWORD);
        $repo = $client->api('repo')->create($username, 'Repository for a ten.java submission.', 'http://tenjava.com', true, null, false, false, false, null, true);
        $client->api('repo')->collaborators()->add("tenjava", $username, $username);
    }

} 