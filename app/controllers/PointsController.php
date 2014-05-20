<?php

use Illuminate\Filesystem\Filesystem;

class PointsController extends BaseController {
    public function showLeaderboard() {
        $filesystem = new Filesystem();
        $pointsData = json_decode($filesystem->get(public_path("assets/data.json")));
        $carbonLast = new \Carbon\Carbon((int) ($pointsData->last_update / 1000));
        $carbonNext = new \Carbon\Carbon((int) ($pointsData->next_update / 1000));
        return View::make("points")->with(array("data" => $pointsData, "next" => $carbonNext, "last" => $carbonLast));
    }
} 