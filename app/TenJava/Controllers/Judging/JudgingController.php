<?php

namespace TenJava\Controllers\Judging;


use Redirect;
use TenJava\Controllers\Abstracts\BaseJudgingController;
use View;

class JudgingController extends BaseJudgingController {

    public function showLatestPlugin() {
        $this->setActive("Judge");
        $this->setPageTitle("Judging");
        if (count($this->judgeClaims['pending']) > 0) {
            return View::make("judging.pages.judge", ["claim" => $this->judgeClaims['pending'][0]]);
        } else {
            return Redirect::to("/judging");
        }
    }

}