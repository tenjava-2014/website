<?php

use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;

class PointsController extends BaseController {
    public function showLeaderboard() {
        $filesystem = new Filesystem();
        $pointsData = json_decode($filesystem->get(public_path("assets/data.json")));
        $carbonLast = Carbon::createFromTimestamp($pointsData->last_update);
        $carbonNext = Carbon::createFromTimestamp($pointsData->next_update);
        return View::make("points")->with(array("data" => $pointsData, "next" => $carbonNext, "last" => $carbonLast));
    }
} 