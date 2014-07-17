<?php

namespace TenJava\Controllers\Judging;


use Response;
use TenJava\Controllers\Abstracts\BaseJudgingController;
use TenJava\Models\JudgeClaim;
use View;

class OversightController extends BaseJudgingController {

    public function showOversight() {
        $this->setActive("Oversight");
        $this->setPageTitle("Oversight");
        return View::make("judging.pages.oversight");
    }

    public function showOversightForm($id) {
        $this->setActive("Oversight");
        $this->setPageTitle("Requesting oversight");
        if (!$this->isClaimOk($id)) {
            return Response::json("Invalid claim.");
        }

        $claim = JudgeClaim::findOrFail($id);
        return View::make("judging.pages.oversight", ["claim" => $claim]);
    }

}
