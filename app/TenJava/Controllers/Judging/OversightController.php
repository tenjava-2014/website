<?php

namespace TenJava\Controllers\Judging;


use TenJava\Controllers\Abstracts\BaseJudgingController;
use View;

class OversightController extends BaseJudgingController {

    public function showOversight() {
        $this->setActive("Oversight");
        $this->setPageTitle("Oversight");
        return View::make("judging.pages.oversight");
    }

}
