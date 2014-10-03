<?php
namespace TenJava\Http\Controllers\Pages;

use TenJava\Http\Controllers\Abstracts\BaseController;
use Response;

class SignupController extends BaseController {

    public function showSignUp() {
        $this->setPageTitle("Sign Up");
        $this->setActive("sign up");
        return Response::view('pages.static.signup', array());
    }

}
