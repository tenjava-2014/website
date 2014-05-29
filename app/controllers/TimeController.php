<?php

class TimeController extends BaseController {

    public function selectUserTimes() {
        $appData = Session::get("application_data");
        $githubUsername = $appData['username'];
        // TODO!
    }

} 