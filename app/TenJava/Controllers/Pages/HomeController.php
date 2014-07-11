<?php
namespace TenJava\Controllers\Pages;

use Input;
use TenJava\Contest\TwitchRepositoryInterface;
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
    /**
     * @var TwitchRepositoryInterface
     */
    private $twitch;

    public function __construct(ContestTimesInterface $contestTimes, ParticipantCommitRepositoryInterface $commits, TwitchRepositoryInterface $twitch) {
        parent::__construct();
        $this->contestTimes = $contestTimes;
        $this->commits = $commits;
        $this->twitch = $twitch;
    }

    public function index() {
        parent::setActive("Home");
        $this->setPageTitle("Home");
        $noJudges = count(Config::get("user-access.present.Judges"));
        $carbonDiff = Carbon::createFromTimeStamp(Config::get("contest-times.t1"));
        $carbonDiff = str_replace("from now", "remaining", $carbonDiff->diffForHumans());

        $viewData = ["noJudges" => $noJudges, "carbonDiff" => $carbonDiff];
        $viewName = "pages.static.post-home";
        $viewData['contestTimes'] = $this->contestTimes;
        $viewData['commits'] = $this->commits->getRecentCommits(5);
        $viewData['twitch'] = $this->twitch->getOnlineStreamers(5, true);
        $multi = "";
        foreach ($viewData['twitch'] as $entry) {
            $multi .= htmlentities($entry->twitch_username . "/");
        }
        $viewData['multi'] = $multi;
        return View::make($viewName)->with($viewData);
    }

    public function ajaxCommits() {
        return View::make("partials.commits", ["commits" => $this->commits->getRecentCommits(5)]);
    }

    public function showStreams() {
        $viewData['twitch'] = $this->twitch->getOnlineStreamers();
        return View::make("pages.dynamic.streams")->with($viewData);
    }

}
