<?php

namespace TenJava\Controllers\Judging;


use TenJava\Controllers\Abstracts\BaseJudgingController;
use View;

class HelpController extends BaseJudgingController {

    public function showHelp() {
        $this->setActive("Help");
        $this->setPageTitle("Help");
        return View::make("judging.pages.help");
    }

} 