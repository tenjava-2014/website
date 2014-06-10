<?php


class Application extends \Illuminate\Database\Eloquent\Model {

    public function timeEntry() {
        return $this->hasOne('ParticipantTimes', 'user_id', 'id');
    }

    public function formatEmails() {
        $emails = json_decode($this->github_email, true);
        if (array_key_exists("public", $emails)) {
            return $emails;
        } else {
            return implode(",", $emails);
        }
    }
}