<?php namespace TenJava\Http\Filters;

use Illuminate\Contracts\Auth\Authenticator;
use Redirect;
use Request;
use TenJava\Exceptions\UnauthorizedException;

class StaffFilter {

    /**
     * @var \Illuminate\Contracts\Auth\Authenticator
     */
    private $auth;

    public function __construct(Authenticator $auth) {
        $this->auth = $auth;
    }

    public function filter() {
        if (!$this->auth->check()) {
            return Redirect::guest('/login');
        } else if ($this->auth->user()->staff === null) {
            throw new UnauthorizedException();
        }
    }
}
