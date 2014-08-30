<?php
namespace TenJava\Controllers\Pages;

use TenJava\Controllers\Abstracts\BaseController;
use Response;
use View;

class ResultsController extends BaseController {

    public function showContestResults() {
        $this->setPageTitle("Results");
        $this->setActive("results");
        if (View::exists("pages.secure.results")) {
            return View::make("pages.secure.results");
        } else {
            return View::make("pages.secure.results-unavailable");
        }
    }

}