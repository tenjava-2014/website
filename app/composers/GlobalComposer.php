<?php

use Illuminate\Filesystem\Filesystem;

class GlobalComposer {

    public function compose($view) {
        $fs = new Filesystem();
        $view->with('pointsData', json_decode($fs->get(public_path("assets/data.json"))));
    }

}