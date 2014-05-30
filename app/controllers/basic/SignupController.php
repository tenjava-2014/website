<?php


class SignupController extends BaseController {

    public function showSignup() {
        $this->setPageTitle("Signup");
        $this->setActive("signup");
        return Response::view('pages.static.signup', array());
    }

} 