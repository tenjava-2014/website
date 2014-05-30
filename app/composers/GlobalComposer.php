<?php

use Illuminate\Filesystem\Filesystem;
use Thujohn\Twitter\Twitter;

class GlobalComposer {
    private $appsCount;
    private $latestAppName;
    private $tweets;
    private $points;

    public function __construct() {
        $fs = new Filesystem();
        $this->points = json_decode($fs->get(public_path("assets/data.json")));
        $this->appsCount = Application::where("judge", false)->count();
        $this->latestAppName = Application::where("judge", false)->orderBy("id", "desc")->pluck("gh_username");
        $this->tweets = Cache::get("tweets");
    }

    public function compose($view) {
        $view->with('pointsData', $this->points);
        $view->with('appsData', (object) ["count" => $this->appsCount, "latestUsername" => $this->latestAppName]);
	    $view->with('lastTweet', $this->tweets);
    }

}