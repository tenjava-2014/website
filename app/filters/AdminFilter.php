<?php

class AdminFilter {

    public function __construct(AuthProviderInterface $auth) {
        $this->auth = $auth;
    }

    public function filter() {
        if (!$this->auth->isStaff()) {
            return Redirect::to("/oauth/confirm")->with("previous", Request::url());
        } else if (!$this->auth->isAdmin()) {
            throw new UnauthorizedException();
        }
    }
} 