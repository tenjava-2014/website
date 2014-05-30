<?php

class StaffFilter {

    public function __construct(AuthProviderInterface $auth) {
        $this->auth = $auth;
    }

    public function filter() {
        die($this->auth->getUsername());
        if (!$this->auth->isLoggedIn()) {
            return Redirect::to("/oauth/confirm");
        } else if (!$this->auth->isStaff()) {
            throw new UnauthorizedException();
        }
    }
} 