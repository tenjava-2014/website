<?php

class AdminFilter {

    public function __construct(AuthProviderInterface $auth) {
        $this->auth = $auth;
    }

    public function filter() {
        if (!$this->auth->isStaff()) {
            return Redirect::to("/oauth/confirm");
        } else if (!$this->auth->isAdmin()) {
            throw new UnauthorizedException();
        }
    }
} 