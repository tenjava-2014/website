<?php

namespace TenJava\Http\Controllers\Judging;


use TenJava\Http\Controllers\Abstracts\BaseJudgingController;
use TenJava\Models\JudgeClaim;
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
        return 25565 + \Auth::id();
    }

}
