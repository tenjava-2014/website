<?php
namespace TenJava\Controllers\Pages;

use DB;
use TenJava\Controllers\Abstracts\BaseController;
use Response;

class ChartsController extends BaseController {

    public function showCharts() {
        $this->setPageTitle("Charts");
        $times = new \stdClass();
        $times->t1 = DB::table("participant_times")->where("t1", true)->count();
        $times->t2 = DB::table("participant_times")->where("t2", true)->count();
        $times->t3 = DB::table("participant_times")->where("t3", true)->count();
        return Response::view('pages.dynamic.charts', array("times" => $times));
    }

} 