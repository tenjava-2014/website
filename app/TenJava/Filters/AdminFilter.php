<?php
namespace TenJava\Filters;

use Redirect;
use Request;
use TenJava\Authentication\AuthProviderInterface;
use TenJava\Exceptions\UnauthorizedException;

class AdminFilter {

    public function __construct(AuthProviderInterface $auth) {
        $this->auth = $auth;
    }

    public function filter() {
        if (!$this->auth->isLoggedIn()) {
            return Redirect::to("/oauth/confirm")->with("previous", Request::url());
        } else if (!$this->auth->isAdmin()) {
            throw new UnauthorizedException();
        }
    }
} 