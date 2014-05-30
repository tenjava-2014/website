<?php

use Illuminate\Filesystem\Filesystem;
use Thujohn\Twitter\Twitter;

class GlobalComposer {
    private $count;

    public function compose($view) {
        $this->count++;
        echo "Composed " . $this->count;
        $fs = new Filesystem();
        $appsCount = Application::where("judge", false)->count();
        $latestAppName = Application::where("judge", false)->orderBy("id", "desc")->pluck("gh_username");
	    $twitter = Cache::get("tweets");
        $view->with('pointsData', json_decode($fs->get(public_path("assets/data.json"))));
        $view->with('appsData', (object) ["count" => $appsCount, "latestUsername" => $latestAppName]);
	    $view->with('lastTweet', $twitter);
    }

}