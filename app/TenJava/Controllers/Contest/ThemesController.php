<?php
namespace TenJava\Controllers\Contest;

use Carbon\Carbon;
use TenJava\Controllers\Abstracts\BaseController;
use TenJava\Time\ContestTimesInterface;
use View;

class ThemesController extends BaseController {
    /**
     * @var ContestTimesInterface
     */
    private $times;

    /**
     * @param ContestTimesInterface $times
     */
    public function __construct(ContestTimesInterface $times) {
        parent::__construct();
        $this->times = $times;
    }

    public function showThemes() {
        $this->setPageTitle("Contest themes");
        $times = $this->times;
       
        $t1Status = "not started, starts in " .  Carbon::createFromTimestamp($times->getT1StartTime())->diffForHumans();
        $t2Status = "not started, starts in " .  Carbon::createFromTimestamp($times->getT2StartTime())->diffForHumans();
        $t3Status = "not started, starts in " .  Carbon::createFromTimestamp($times->getT3StartTime())->diffForHumans();
        if ($times->isT1Active()) {
            $t1Status = "started, ends in " .  Carbon::createFromTimestamp($times->getT1EndTime())->diffForHumans();
        }
        if ($times->isT2Active()) {
            $t2Status = "started, ends in " .  Carbon::createFromTimestamp($times->getT2EndTime())->diffForHumans();
        }
        if ($times->isT3Active()) {
            $t3Status = "started, ends in " .  Carbon::createFromTimestamp($times->getT3EndTime())->diffForHumans();
        }

        if ($times->isT1Finished()) {
            $t1Status = "ended";
        }
        if ($times->isT2Finished()) {
            $t2Status = "ended";
        }
        if ($times->isT3Finished()) {
            $t3Status = "ended";
        }

        return View::make("pages.static.themes")->with(["times" => $times, "t1" => $t1Status, "t2" => $t2Status, "t3" => $t3Status]);
    }
} 
