<?php
namespace TenJava\Http\Filters;

use Redirect;
use Request;
use TenJava\Authentication\AuthProviderInterface;
use TenJava\Exceptions\UnauthorizedException;

class ProtectedApiFilter {

    public function filter() {
        if (Request::header('X-API-Token', 'wrong') !== $_ENV['API_TOKEN']) {
            throw new UnauthorizedException();
        }
    }
}
