<?php namespace TenJava;

use Illuminate\Contracts\Auth\Authenticator;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Redirect;
use Session;
use TenJava\Repository\UserRepository;

class AuthenticateUser {

    /**
     * @var \Laravel\Socialite\Contracts\Factory
     */
    private $socialite;
    /**
     * @var \Illuminate\Contracts\Auth\Authenticator
     */
    private $auth;
    /**
     * @var Repository\UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository, Socialite $socialite, Authenticator $auth) {
        $this->socialite = $socialite;
        $this->auth = $auth;
        $this->userRepository = $userRepository;
    }

    public function execute($hasCode) {
        if (!$hasCode) return $this->getAuthorizationFirst();
        $user = $this->userRepository->getGitHubUser($this->getGitHubUser());
        $this->auth->login($user);
        return Redirect::back();
    }

    public function logout() {
        $this->auth->logout();
        Session::clear();
        return Redirect::route('index');
    }

    private function getAuthorizationFirst() {
        return $this->getDriver()->redirect();
    }

    private function getDriver() {
        return $this->socialite->driver('github_email');
    }

    private function getGitHubUser() {
        return $this->getDriver()->user();
    }

}
