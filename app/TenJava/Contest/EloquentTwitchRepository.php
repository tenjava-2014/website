<?php
namespace TenJava\Contest;

use DB;
use TenJava\Models\Application;

class EloquentTwitchRepository implements TwitchRepositoryInterface {

    public function getOnlineStreamers($max=null, $random=false) {
        if ($max !== null) {
            if ($random) {
                return Application::with('timeEntry')->has("onlineStream", ">", "0")->orderBy(DB::raw('RAND()'))->take($max)->get();
            } else {
                return Application::with('timeEntry')->has("onlineStream", ">", "0")->take($max)->get();
            }
        }
        return Application::with('timeEntry')->has("onlineStream", ">", "0")->get();
    }
}