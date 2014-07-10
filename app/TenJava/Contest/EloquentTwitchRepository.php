<?php
namespace TenJava\Contest;

use TenJava\Models\Application;

class EloquentTwitchRepository implements TwitchRepositoryInterface {

    public function getOnlineStreamers($max=null) {
        if ($max !== null) {
            return Application::with('timeEntry')->has("onlineStream", ">", "0")->take($max)->get();
        }
        return Application::with('timeEntry')->has("onlineStream", ">", "0")->get();
    }
}