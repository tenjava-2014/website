<?php

class HomeController extends BaseController {

    public function index() {
        parent::setActive("Home");
        $this->setPageTitle("Home");
        $noJudges = count(Config::get("user-access.present.Judges"));
        return View::make('pages.static.home')->with(["noJudges" => $noJudges]);
    }

}
