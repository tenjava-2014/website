<?php

namespace TenJava\Http\Controllers\Judging;


use TenJava\Http\Controllers\Abstracts\BaseJudgingController;
use View;

class HelpController extends BaseJudgingController {

    public function showHelp() {
        $this->setActive("Help");
        $this->setPageTitle("Help");
        return View::make("judging.pages.help");
    }

}
