<?php
namespace TenJava\Controllers\Pages;

use DB;
use TenJava\Controllers\Abstracts\BaseController;
use Response;
use TenJava\Models\Application;

class ChartsController extends BaseController {

    public function showCharts() {
        $this->setPageTitle("Charts");
        $times = new \stdClass();
        $times->t1 = DB::table("participant_times")->where("t1", true)->count();
        $times->t2 = DB::table("participant_times")->where("t2", true)->count();
        $times->t3 = DB::table("participant_times")->where("t3", true)->count();
        $confirmed = new \stdClass();
        $confirmed->co = Application::with('timeEntry')->has("timeEntry", ">", "0")->where('judge', false)->count();
        $confirmed->uc = Application::with('timeEntry')->has("timeEntry", "=", "0")->where('judge', false)->count();
        return Response::view('pages.dynamic.charts', array("times" => $times, "confirmed" => $confirmed));
    }

} 