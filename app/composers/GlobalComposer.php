<?php

use Illuminate\Filesystem\Filesystem;
use Thujohn\Twitter\Twitter;

class GlobalComposer {

    public function compose($view) {
        $fs = new Filesystem();
        $appsCount = Application::where("judge", false)->count();
        $latestAppName = Application::where("judge", false)->orderBy("id", "desc")->pluck("gh_username");

        $view->with('pointsData', json_decode($fs->get(public_path("assets/data.json"))));
        $view->with('appsData', (object) ["count" => $appsCount, "latestUsername" => $latestAppName]);
	    $view->with('lastTweet', Twitter::getUserTimeline(array('screen_name' => 'tenjava', 'count' => 1, 'format' => 'array')));
    }

}