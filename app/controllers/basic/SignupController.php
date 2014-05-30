<?php


class SignupController extends BaseController {

    public function showAbout() {
        $this->setPageTitle("Signup");
        $this->setActive("signup");
        return Response::view('pages.static.signup', array());
    }

} 