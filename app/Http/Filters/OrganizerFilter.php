<?php
namespace TenJava\Filters;

use Illuminate\Contracts\Auth\Authenticator;
use Redirect;
use Request;
use TenJava\Exceptions\UnauthorizedException;

class OrganizerFilter {

    public function __construct(Authenticator $auth) {
        $this->auth = $auth;
    }

    public function filter() {
        if (!$this->auth->check()) {
            return Redirect::guest('/login');
        }
        $staff = $this->auth->user()->staff;
        if ($staff === null || !$staff->isOrganizer()) {
            throw new UnauthorizedException();
        }
    }
}
