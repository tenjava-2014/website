<?php
namespace TenJava\Http\Controllers\Pages;

use Carbon\Carbon;
use Config;
use Input;
use TenJava\Contest\TwitchRepositoryInterface;
use TenJava\Http\Controllers\Abstracts\BaseController;
use View;

class HomeController extends BaseController {

    public function ajaxCommits() {
        return View::make("partials.commits", ["commits" => []]);
    }

    public function index() {
        parent::setActive("Home");
        $this->setPageTitle("Home");
        $carbonDiff = Carbon::createFromTimeStamp(Config::get("contest-times.t1"));
        $carbonDiff = str_replace("from now", "remaining", $carbonDiff->diffForHumans());

        $viewData = ["carbonDiff" => $carbonDiff];
        $viewName = "pages.static.home";
        return View::make($viewName)->with($viewData);
    }

    public function showStreams(TwitchRepositoryInterface $twitch) {
        $viewData['twitch'] = $twitch->getOnlineStreamers();
        return View::make("pages.dynamic.streams")->with($viewData);
    }

}
