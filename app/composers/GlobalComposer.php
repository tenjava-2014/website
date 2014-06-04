<?php

use Illuminate\Filesystem\Filesystem;

class GlobalComposer {
    private $appsCount;
    private $latestAppName;
    private $tweets;
    private $points;

    /**
     * @return mixed
     */
    public function getPoints() {
        return $this->points;
    }

    private $judgeCount;

    public function __construct() {
        $this->optOut = App::make("EmailOptOutInterface");
        $fs = new Filesystem();
        $this->points = json_decode($fs->get(public_path("assets/data.json")));
        $this->appsCount = Application::where("judge", false)->count();
        $this->judgeCount = Application::where("judge", true)->count();
        $this->latestAppName = Application::where("judge", false)->orderBy("id", "desc")->pluck("gh_username");
        $this->tweets = Cache::get("tweets");
    }

    public function compose($view) {
        $view->with('pointsData', $this->points);
        $view->with('appsData', (object) ["count" => $this->appsCount, "judgeCount" => $this->judgeCount, "latestUsername" => $this->latestAppName]);
	    $view->with('tweets', $this->tweets);
        $view->with("emailOptOut", !$this->optOut->isOptedIn());
    }

}