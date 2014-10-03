<?php

namespace TenJava\Composers;

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
    }

}
