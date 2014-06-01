<?php

class AppController extends BaseController {

    public function  __construct() {
        parent::__construct();
        $this->beforeFilter('AuthenticationFilter');
    }

    /**
     * @return array
     */
    public static function getLimitedUsers() {
        $limitedUsers = array(
            "CaptainBern", // judge
            "MasterEjay", // judge
            "aerouk", // judge
            "lDucks", // judge
            "ttaylorr", // judge
            "njb-said", // judge
            "pogostick29dev", // judge
            "ShadowWizardMC" // judge
        );
        return $limitedUsers;
    }

    /**
     * @return array
     */
    public static function getAuthorisedUsers() {
        $authorisedUsers = array(
            "lol768", // organiser
            "jkcclemens", // organiser
            "hawkfalcon" // organiser
        );
        return $authorisedUsers;
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

    public function declineJudgeApp($id) {
        $appData = Session::get("application_data");
        $githubUsername = $appData['username'];

        /**
         * These users can see contact information if the applicant chose to disclose it to us.
         */
        $authorisedUsers = self::getAuthorisedUsers();

        if (!in_array($githubUsername, $authorisedUsers)) {
            if (!$githubUsername) {
                return Redirect::to("/oauth/confirm")->with('intent', 'admin');
            } else {
                return Response::json("No auth.");
            }
        } else {
            $app = Application::findOrFail($id);
            $username = $app->gh_username;
            $gmail = $app->gmail;
            Mail::queue(array('text' => 'emails.judge.decline'), array("user" => $username), function ($message) use ($gmail) {
                $message->from('tenjava@tenjava.com', 'ten.java Team');
                $message->to($gmail)->subject('Your recent judge application');
            });
            $app->delete();
            return Redirect::back();
        }
    }

    public function listApps() {
        $appData = Session::get("application_data");
        $githubUsername = $appData['username'];

        /**
         * These users can see contact information if the applicant chose to disclose it to us.
         */
        $authorisedUsers = self::getAuthorisedUsers();

        /**
         * These users (typically judges) can see IRC/twitch/DBO usernames but cannot see emails.
         */
        $limitedUsers = self::getLimitedUsers();

        if (!in_array($githubUsername, $limitedUsers) && !in_array($githubUsername, $authorisedUsers)) {
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
            } else {
                if (Input::has("normal")) {
                    $viewData['apps'] = Application::where('judge', false)->paginate(5);
                    $viewData['append'] = array("normal" => "1");
                } else {
                    $viewData['apps'] = Application::paginate(5);
                }
            }

            return View::make("pages.staff.app-list")->with($viewData);
        }
    }

    public function processApplication($type) {
        $dupeApp = false;
        if (Application::where("gh_username", $this->auth->getUsername())->first() != null) {
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
