<?php

namespace TenJava\Controllers\Judging;


use TenJava\Controllers\Abstracts\BaseJudgingController;
use View;

class DashboardController extends BaseJudgingController {

    public function showDashboard() {
        $this->setActive("Dashboard");
        $this->setPageTitle("Dashboard");
        return View::make("judging.pages.dashboard", $this->getViewData());
    }

    private function getViewData() {
        return ["judgePort" => $this->getServerPort()];
    }

    private function getServerPort() {
        $auth = $this->auth;
        return 25565 + $auth->getJudgeId();
    }

}