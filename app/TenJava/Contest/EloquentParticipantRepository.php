<?php
namespace TenJava\Contest;

use TenJava\Models\Application;

class EloquentParticipantRepository implements ParticipantRepositoryInterface {

    public function getConfirmedParticipants() {
        // let's return an eloquent model and defeat the entire purpose of abstracting our database logic
        return Application::with('timeEntry')->has("timeEntry", ">", "0")->where('judge', false)->get();
    }

    public function getUnconfirmedParticipants() {
        return Application::with('timeEntry')->has("timeEntry", "=", "0")->where('judge', false)->get();
    }

    public function getParticipantByAuthId($id) {
        return Application::with('commits')->where('gh_id', $id)->get();
    }
}