<?php

namespace TenJava\Controllers\Judging;


use TenJava\Controllers\Abstracts\BaseJudgingController;
use TenJava\Models\JudgeClaim;
use View;

class DashboardController extends BaseJudgingController {

    public function showDashboard() {
        $this->setActive("Dashboard");
        $this->setPageTitle("Dashboard");
        $this->processClaims();
        return View::make("judging.pages.dashboard", $this->getViewData());
    }

    private function getViewData() {
        return ["judgePort" => $this->getServerPort(), "claims" => $this->processClaims()];
    }

    private function processClaims() {
        $claimData = ["total" => 0, "done" => [], "pending" => []];
        $claims = $this->judgeClaims;
        foreach ($claims as $claim) {
            /** @var $claim JudgeClaim */
            if ($claim->result != null) {
                $claimData['done'][] = $claim;
            } else {
                $claimData['pending'][] = $claim;
            }
            $claimData['total'] += 1;
        }
        return $claimData;
    }

    private function getServerPort() {
        $auth = $this->auth;
        return 25565 + $auth->getJudgeId();
    }

}