<?php

class TimeController extends BaseController {

    public function showUserTimes() {
        $appData = Session::get("application_data");
        $githubUsername = $this->auth->getUsername();
        return View::make("pages.forms.time-selection")->with(array("username" => $githubUsername));
    }

} 