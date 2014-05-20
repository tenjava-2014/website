<?php

use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;

class PointsController extends BaseController {
    public function showLeaderboard() {
        $filesystem = new Filesystem();
        $pointsData = json_decode($filesystem->get(public_path("assets/data.json")));
        $recent = $this->getFirst($pointsData->recent_transactions, 5);
        $top = $this->getFirstAssociative($pointsData->top_donors, 5);

        $carbonLast = Carbon::createFromTimestamp($pointsData->last_update);
        $carbonNext = Carbon::createFromTimestamp($pointsData->next_update);

        $goalPercent = $pointsData->points / 4645;
        $goalPercent = round($goalPercent * 100, 2);

        return View::make("points")->with(array("data" => $pointsData, "goal" => $goalPercent, "next" => $carbonNext, "last" => $carbonLast, "top" => $top, "recent" => $recent));
    }

    private function getFirst($object, $amount) {
        $i = 0;
        $new = [];
        foreach ($object as $obj) {
            $i++;
            if ($i > $amount) {
                break;
            }
            $new[] = $obj;
        }
        return $new;
    }

    private function getFirstAssociative($object, $amount) {
        $i = 0;
        $new = [];
        foreach ($object as $obj => $value) {
            $i++;
            if ($i > $amount) {
                break;
            }
            $new[$obj] = $value;
        }
        return $new;
    }
} 