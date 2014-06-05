<?php


class Application extends \Illuminate\Database\Eloquent\Model {

    public function timeEntry() {
        return $this->hasOne('ParticipantTimes', 'user_id', 'id');
    }
}