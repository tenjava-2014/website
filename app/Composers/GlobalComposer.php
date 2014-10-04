<?php

namespace TenJava\Composers;

use Auth;
use Illuminate\Cache\Repository as CacheRepository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application as App;
use Illuminate\View\View;

class GlobalComposer {

    public function __construct(App $app, CacheRepository $cache) {
        $this->tweets = $cache->get("tweets");
    }

    public function compose(View $view) {
        $view->with('tweets', $this->tweets);
        $view->with('emailOptOut', $this->getEmailOptOut());
    }

    private function getEmailOptOut() {
        if (Auth::check()) {
            return Auth::user()->getOptoutStatus();
        } else {
            return false;
        }
    }

}
