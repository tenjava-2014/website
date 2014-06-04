<?php

class HomeController extends BaseController {

    public function index() {
        parent::setActive("Home");
        $this->setPageTitle("Home");
        return View::make('pages.static.home');
    }

}
