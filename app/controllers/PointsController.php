<?php

use Illuminate\Filesystem\Filesystem;

class PointsController extends BaseController {
    public function showLeaderboard() {
        $filesystem = new Filesystem();
        $pointsData = json_decode($filesystem->get(public_path("assets/data.json")));
        $carbonLast = new \Carbon\Carbon($pointsData->last_update);
        $carbonNext = new \Carbon\Carbon($pointsData->next_update);
        return View::make("points")->with(array("data" => $pointsData, "next" => $carbonNext, "last" => $carbonLast));
    }
} 