<?php

class TimeController extends BaseController {

    public function showUserTimes() {
        $githubUsername = $this->auth->getUsername();
        $ghId = $this->auth->getUserId();
        $appCount = Application::where("gh_id", $ghId)->where("judge", false)->count();
        if ($appCount == 0) {
            $errorController = App::make("ErrorController");
            return $errorController->priorapp();
        }
        return View::make("pages.forms.time-selection")->with(array("username" => $githubUsername));
    }

    public function confirmUserTimes() {
        $ghId = $this->auth->getUserId();
        $app = Application::where("gh_id", $ghId)->first();

    }

} 