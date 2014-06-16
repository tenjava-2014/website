<?php

namespace TenJava\Composers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application as App;
use Illuminate\Cache\Repository as CacheRepository;
use Illuminate\View\View;
use TenJava\Authentication\AuthProviderInterface;
use TenJava\Authentication\EmailOptOutInterface;
use TenJava\Models\Application;

class GlobalComposer {
    private $appsCount;
    private $latestAppName;
    private $tweets;
    private $points;
    private $judgeCount;
    private $auth;

    public function __construct(App $app, CacheRepository $cache, EmailOptOutInterface $optOut, AuthProviderInterface $auth) {
        $this->optOut = $optOut;
        $fs = new Filesystem();
        $this->points = json_decode($fs->get(public_path("assets/data.json")));
        $this->appsCount = Application::where("judge", false)->count();
        $this->judgeCount = Application::where("judge", true)->count();
        $this->latestAppName = Application::where("judge", false)->orderBy("id", "desc")->pluck("gh_username");
        $this->tweets = $cache->get("tweets");
        $this->auth = $auth;
    }

    public function compose(View $view) {
        $view->with('pointsData', $this->points);
        $view->with('appsData', (object)[
            "count" => $this->appsCount,
            "judgeCount" => $this->judgeCount,
            "latestUsername" => $this->latestAppName]);
        $view->with('tweets', $this->tweets);
        $view->with('auth', $this->auth);
        $view->with("emailOptOut", !$this->optOut->isOptedIn());

    }

    /**
     * @return mixed
     */
    public function getPoints() {
        return $this->points;
    }

}
