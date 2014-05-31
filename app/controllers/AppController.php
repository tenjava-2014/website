<?php

use Illuminate\Support\Facades\Mail;

class AppController extends BaseController {

    public function  __construct(AuthProviderInterface $auth) {
        parent::__construct();
        $this->auth = $auth;
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

    public function applyJudge() {
        $this->setActive("sign up");
        return View::make("pages.forms.judge", array("username" => $this->auth->getUsername()));
    }

    public function applyParticipant() {
        $this->setActive("sign up");
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
                $message->from('no-reply@tenjava.com', 'ten.java Team');
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
            $client = $this->getUserApiClient();
            $numRepos = count($client->repositories($appData['username']));
            $githubTest = ($numRepos != 0);
            $validator = Validator::make(
                array(
                     'dbo' => Input::get("dbo"),
                     'mc' => Input::get("mcign"),
                     'gmail' => Input::get("gdocs"),
                     'irc' => Input::get("irc"),
                     'githubAcceptable' => ($githubTest) ? "OK" : ""
                ),
                array(
                     'dbo' => 'required|max:255',
                     'mc' => 'required|max:16',
                     'irc' => 'required|max:255',
                     'gmail' => 'required|email|max:255',
                     'githubAcceptable' => 'required'
                ),
                array(
                     'githubAcceptable.required' => 'Sorry, you do not meet the minimum requirements for a judge.',
                     'mc.max' => 'Invalid Minecraft username specified.',
                     'mc.required' => 'No Minecraft username specified.',
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
            return View::make("pages.result.thanks");
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
