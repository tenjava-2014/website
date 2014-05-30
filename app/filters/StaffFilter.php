<?php

class StaffFilter {

    public function __construct(AuthProviderInterface $auth) {
        $this->auth = $auth;
    }

    public function filter() {
        if (!$this->auth->isLoggedIn()) {
            return Redirect::to("/oauth/confirm")->with("previous", Request::url());
        } else if (!$this->auth->isStaff()) {
            throw new UnauthorizedException();
        }
    }
} 