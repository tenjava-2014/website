<?php
namespace TenJava\Controllers\Pages;

use TenJava\Controllers\Abstracts\BaseController;
use Response;

class ScoreViewController extends BaseController {

    public function showScores() {
        $this->setPageTitle("Your entry scores");
        return Response::view('pages.dynamic.own-scores');
    }

} 