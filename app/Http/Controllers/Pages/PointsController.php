<?php
namespace TenJava\Http\Controllers\Pages;

use TenJava\Http\Controllers\Abstracts\BaseController;
use Carbon\Carbon;
use View;
use App;

class PointsController extends BaseController {
    public function showLeaderboard() {
        $this->setActive("points");
        $this->setPageTitle("Points");
        /*$pointsData = App::make("GlobalComposer")->getPoints();
        $recent = $this->getFirst($pointsData->recent_transactions, 5);
        $numDonors = count(get_object_vars($pointsData->top_donors));
        $top = $this->getFirstAssociative($pointsData->top_donors, 5);

        $carbonLast = Carbon::createFromTimestamp($pointsData->last_update);
        $carbonNext = Carbon::createFromTimestamp($pointsData->next_update);

        $goalPercent = $pointsData->points / 4644;
        $goalPercent = round($goalPercent * 100, 2);*/

        return View::make("pages.dynamic.points"); /*->with(array("data" => $pointsData, "goal" => $goalPercent, "next" => $carbonNext,
                                                "last" => $carbonLast, "top" => $top, "recent" => $recent,
                                                "totalCount" => $numDonors));*/
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
