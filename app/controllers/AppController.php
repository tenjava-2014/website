<?php

class AppController extends BaseController {

    public function  __construct() {
        parent::__construct();
        $this->beforeFilter('AuthenticationFilter');
    }

    public function showApplyJudge() {
        $this->setActive("sign up");
        $this->setPageTitle("Judge application");
        return View::make("pages.forms.judge", array("username" => $this->auth->getUsername()));
    }

    public function showApplyParticipant() {
        $this->setActive("sign up");
        $this->setPageTitle("Registration");
        return View::make("pages.forms.participant", array("username" => $this->auth->getUsername()));
    }

    public function declineJudgeApp() {
        $app = Application::findOrFail(Input::get("app_id"));
        $username = $app->gh_username;
        $gmail = $app->gmail;
        Mail::queue(array('text' => 'emails.judge.decline'), array("user" => $username), function ($message) use ($gmail) {
            $message->from('tenjava@tenjava.com', 'ten.java Team');
            $message->to($gmail)->subject('Your recent judge application');
        });
        $app->delete();
        return Redirect::back();

    }

    public function acceptJudgeApp() {
        $app = Application::findOrFail(Input::get("app_id"));
        $username = $app->gh_username;
        $gmail = $app->gmail;
        Mail::queue(array('text' => 'emails.judge.accept'), array("user" => $username), function ($message) use ($gmail) {
            $message->from('tenjava@tenjava.com', 'ten.java Team');
            $message->to($gmail)->subject('Your recent judge application');
        });
        $app->delete();
        return Redirect::back();
    }

    public function listApps() {
        $this->setPageTitle("Application list");
        $this->setActive("App list");

        $viewData = array(
            "append" => array(),
            "apps" => null,
            "fullAccess" => false
        );

        if ($this->auth->isAdmin()) {
            $viewData["fullAccess"] = true;
        }

        if (Input::has("judges")) {
            $viewData['apps'] = Application::with('timeEntry')->where('judge', true)->paginate(5);
            $viewData['append'] = array("judges" => "1");
        } else {
            if (Input::has("normal")) {
                $viewData['apps'] = Application::with('timeEntry')->where('judge', false)->paginate(5);
                $viewData['append'] = array("normal" => "1");
            } else {
                if (Input::has("unc")) {
                    $viewData['apps'] = Application::with('timeEntry')->has("timeEntry", "=", "0")->where('judge', false)->paginate(5);
                    $viewData['append'] = array("unc" => "1");
                } else {
                    $viewData['apps'] = Application::with('timeEntry')->paginate(5);
                }

            }
        }

        return View::make("pages.staff.app-list")->with($viewData);

    }

    public function processApplication($type) {
        $dupeApp = false;
        if (Application::where("gh_id", $this->auth->getUserId())->first() != null) {
            $dupeApp = true;
        }
        if ($type !== "participant" && $type !== "judge") {
            return App::make("ErrorController")->badRequest("Invalid application type was supplied.");
        }
        if ($type === "participant") {
            $validator = Validator::make(
                array(
                    'dbo' => Input::get("dbo"),
                    'twitch' => Input::get("twitch"),
                    "dupeApp" => !$dupeApp
                ),
                array(
                    'dbo' => 'required|max:255',
                    'twitch' => 'max:255',
                    "dupeApp" => "accepted"
                ),
                array(
                    'dupeApp.accepted' => "An application/registration entry already exists for this user."
                )
            );
            if ($validator->fails()) {
                return Redirect::to("/register/participant")->withErrors($validator)->withInput();
            }
            $app = new Application();
            $app->gh_username = $this->auth->getUsername();
            $app->github_email = json_encode($this->auth->getEmails());
            $app->judge = false;
            $app->gh_id = $this->auth->getUserId();
            $app->dbo_username = Input::get("dbo");
            if (!Input::has("twitch")) {
                $app->twitch_username = "USER_REJECTED"; //field not nullable so this will have to do.
            } else {
                $app->twitch_username = Input::get("twitch");
            }
            $app->save();
            return View::make("pages.result.thanks.participant")->with(array("username" => $this->auth->getUsername()));
        } else {
            $client = $this->getUserApiClient();
            $numRepos = count($client->repositories($this->auth->getUsername()));
            $githubTest = ($numRepos != 0);
            $validator = Validator::make(
                array(
                    'dbo' => Input::get("dbo"),
                    'mc' => Input::get("mcign"),
                    'gmail' => Input::get("gdocs"),
                    'irc' => Input::get("irc"),
                    'githubAcceptable' => ($githubTest) ? "OK" : "",
                    "dupeApp" => !$dupeApp
                ),
                array(
                    'dbo' => 'required|max:255',
                    'mc' => 'required|max:16',
                    'irc' => 'required|max:255',
                    'gmail' => 'required|email|max:255',
                    'githubAcceptable' => 'required',
                    "dupeApp" => "accepted"
                ),
                array(
                    'githubAcceptable.required' => 'Sorry, you do not meet the minimum requirements for a judge.',
                    'mc.max' => 'Invalid Minecraft username specified.',
                    'mc.required' => 'No Minecraft username specified.',
                    'dupeApp.accepted' => "An application/registration entry already exists for this user."
                )
            );
            if ($validator->fails()) {
                return Redirect::to("/register/judge")->withErrors($validator)->withInput();
            }
            $app = new Application();
            $app->gh_username = $this->auth->getUsername();
            $app->github_email = json_encode($this->auth->getEmails());
            $app->judge = true;
            $app->gh_id = $this->auth->getUserId();
            $app->dbo_username = Input::get("dbo");
            $app->irc_username = Input::get("irc");
            $app->mc_username = Input::get("mcign");
            $app->gmail = Input::get("gdocs");
            $app->save();
            return View::make("pages.result.thanks.judge")->with(array("username" => $this->auth->getUsername()));
        }
    }

    public function addUserRepo($username) {
        //$client = new \Github\Client();
        //$client->authenticate("tenjava", Config::get("gh-data.pass"), \GitHub\Client::AUTH_HTTP_PASSWORD);
        //$repo = $client->api('repo')->create($username, 'Repository for a ten.java submission.', 'http://tenjava.com', true, null, false, false, false, null, true);
        //$client->api('repo')->collaborators()->add("tenjava", $username, $username);
    }

    /**
     * @return \Github\Api\User
     */
    public function getUserApiClient() {
        $client = new \Github\Client();
        $client->authenticate("tenjava", Config::get("gh-data.pass"), \GitHub\Client::AUTH_HTTP_PASSWORD);
        return $client->api("user");
    }

} 
