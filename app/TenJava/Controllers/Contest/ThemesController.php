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
       
        $t1Status = "not started, starts in " .  $this->getTimeHtml($times->getT1StartTime());
        $t2Status = "not started, starts in " .  $this->getTimeHtml($times->getT2StartTime());
        $t3Status = "not started, starts in " .  $this->getTimeHtml($times->getT3StartTime());
        if ($times->isT1Active()) {
            $t1Status = "started, ends in " .  $this->getTimeHtml($times->getT1EndTime());
        }
        if ($times->isT2Active()) {
            $t2Status = "started, ends in " .  $this->getTimeHtml($times->getT2EndTime());
        }
        if ($times->isT3Active()) {
            $t3Status = "started, ends in " .  $this->getTimeHtml($times->getT3EndTime());
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

    private function getTimeHtml($ts) {
        $carbon = Carbon::createFromTimestampUTC($ts);
        $carbonStr = $carbon->diffForHumans();
        $str = $carbon->format('c');
        return '<time datetime="' . $str .  '">' . $carbonStr . '</time>';
    }
} 
