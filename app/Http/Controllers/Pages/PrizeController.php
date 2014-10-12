<?php
namespace TenJava\Http\Controllers\Pages;

use App;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use TenJava\Http\Controllers\Abstracts\BaseController;
use View;

class PrizeController extends BaseController {
    public function showLeaderboard() {
        $this->setActive('prize');
        $this->setPageTitle('Prize');
        /** @var \TenJava\Composers\GlobalComposer $globalComposer */
        $globalComposer = App::make('TenJava\Composers\GlobalComposer');
        $pointsData = $globalComposer->getPointsData();
        $goalPercent = round($pointsData['totalMoney'] / 21, 2); // / 2100 * 100 becomes / 21
        $pointsData['goal'] = $goalPercent;
        return View::make("pages.dynamic.prize")->with($pointsData->getArrayCopy());
    }
}
