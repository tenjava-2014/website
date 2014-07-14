<?php

namespace TenJava\Controllers\Judging;


use TenJava\Controllers\Abstracts\BaseJudgingController;
use View;

class DashboardController extends BaseJudgingController {

    public function showDashboard() {
        $this->setActive("Dashboard");
        $this->setPageTitle("Dashboard");
        return View::make("judging.pages.dashboard");
    }

} 