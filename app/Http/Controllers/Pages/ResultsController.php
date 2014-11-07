<?php
namespace TenJava\Http\Controllers\Pages;

use Response;
use TenJava\Http\Controllers\Abstracts\BaseController;
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
