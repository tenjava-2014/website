<?php
namespace TenJava\Controllers\Pages;

use Input;
use TenJava\Controllers\Abstracts\BaseController;
use Carbon\Carbon;
use Config;
use TenJava\Time\ContestTimesInterface;
use View;

class HomeController extends BaseController {

    /**
     * @var ContestTimesInterface
     */
    private $contestTimes;

    public function __construct(ContestTimesInterface $contestTimes) {
        parent::__construct();
        $this->contestTimes = $contestTimes;
    }

    public function index() {
        parent::setActive("Home");
        $this->setPageTitle("Home");
        $noJudges = count(Config::get("user-access.present.Judges"));
        $carbonDiff = Carbon::createFromTimeStamp(Config::get("contest-times.t1"));
        $carbonDiff = str_replace("from now", "remaining", $carbonDiff->diffForHumans());
        $viewName = 'pages.static.home';

        $viewData = ["noJudges" => $noJudges, "carbonDiff" => $carbonDiff];
        if (Input::has("new-home")) {
            $viewName = "pages.static.post-home";
            $viewData['contestTimes'] = $this->contestTimes;
        }
        return View::make($viewName)->with($viewData);
    }

}
