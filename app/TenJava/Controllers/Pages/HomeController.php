<?php
namespace TenJava\Controllers\Pages;

use Input;
use TenJava\Controllers\Abstracts\BaseController;
use Carbon\Carbon;
use Config;
use TenJava\Models\ParticipantCommit;
use TenJava\Repository\ParticipantCommitRepositoryInterface;
use TenJava\Time\ContestTimesInterface;
use View;

class HomeController extends BaseController {

    /**
     * @var ContestTimesInterface
     */
    private $contestTimes;
    /**
     * @var ParticipantCommitRepositoryInterface
     */
    private $commits;

    public function __construct(ContestTimesInterface $contestTimes, ParticipantCommitRepositoryInterface $commits) {
        parent::__construct();
        $this->contestTimes = $contestTimes;
        $this->commits = $commits;
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
            $viewData['commits'] = $this->commits->getRecentCommits(5);
        }
        return View::make($viewName)->with($viewData);
    }

    public function ajaxCommits() {
        return View::make("pages.dynamic.commits", ["commits" => $this->commits->getRecentCommits(5)]);
    }

}
