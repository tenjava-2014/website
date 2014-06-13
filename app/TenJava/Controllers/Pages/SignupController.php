<?php
namespace TenJava\Controllers\Pages;

use TenJava\Controllers\Abstracts\BaseController;

class SignupController extends BaseController {

    public function showSignUp() {
        $this->setPageTitle("Sign Up");
        $this->setActive("sign up");
        return Response::view('pages.static.signup', array());
    }

} 