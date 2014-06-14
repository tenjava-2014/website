<?php
namespace TenJava\Controllers\Pages;

use TenJava\Controllers\Abstracts\BaseController;
use Carbon\Carbon;
use Config;
use View;

class HomeController extends BaseController {

    public function index() {
        parent::setActive("Home");
        $this->setPageTitle("Home");
        $noJudges = count(Config::get("user-access.present.Judges"));
        $carbonDiff = Carbon::createFromTimeStamp(Config::get("contest-times.t1"));
        $carbonDiff = str_replace("from now", "remaining", $carbonDiff->diffForHumans());
        return View::make('pages.static.home')->with(["noJudges" => $noJudges, "carbonDiff" => $carbonDiff]);
    }

}
