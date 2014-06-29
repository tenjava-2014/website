<?php
namespace TenJava\Controllers\Authentication;

use Artdarek\OAuth\Facade\OAuth;
use Input;
use Redirect;
use Session;
use TenJava\Authentication\EmailOptOutInterface;
use TenJava\Controllers\Abstracts\BaseController;
use OAuth\Common\Http\Exception\TokenResponseException;
use TenJava\Exceptions\FailedOauthException;
use TenJava\Models\Judge;
use View;

class AuthController extends BaseController {

    public function __construct(EmailOptOutInterface $optOut) {
        parent::__construct();
        $this->optOut = $optOut;
    }

    public function loginWithGitHub() {

        Session::reflash(); // pass data on for after POST back from GH
        $code = Input::get('code');
        if (Input::has("error")) {
            $this->throwOauthError();
        }

        $githubService = $this->getOauthConsumer(!$this->optOut->isOptedIn());

        if (!empty($code)) {

            // This was a callback request from github, get the token
            try {
                $token = $githubService->requestAccessToken($code);
            } catch (TokenResponseException $e) {
                $this->throwOauthError();
            }

            // Send a request with it
            $result = json_decode($githubService->request('user'), true);
            $emails = array("fail" => "user rejected request");
            if ($this->optOut->isOptedIn()) {
                $emails = json_decode($githubService->request("user/emails"), true);
            }
            $githubUsername = $result['login'];
            Session::put("application_data", array("id" => $result['id'], "username" => $githubUsername, "emails" => $emails));

            $judge = Judge::where("github_id", $result['id'])->first();
            if ($judge !== null) {
                Session::put("judge", $judge);
            }
            return Redirect::to(Session::get("previous"));

        } // if not ask for permission first
        else {
            $url = $githubService->getAuthorizationUri();

            // return to github login url
            return Redirect::to((string)$url);
        }
    }

    public function showRefusal() {
        return View::make("pages.auth.refusal");
    }

    private function throwOauthError() {
        throw new FailedOauthException();
    }

    public function toggleOptOut() {
        $this->optOut->setIsOptedIn(!$this->optOut->isOptedIn());
        return Redirect::to("/privacy#email-access");
    }

    /**
     * @param boolean $optOut If the user opts-out of email sharing.
     * @return \OAuth\OAuth2\Service\GitHub
     */
    private function getOauthConsumer($optOut) {
        if ($optOut) {
            return OAuth::consumer('GitHub', null, array());
        } else {
            return OAuth::consumer('GitHub');
        }
    }

} 