<?php


class Application extends \Illuminate\Database\Eloquent\Model {

    public function timeEntry() {
        return $this->hasOne('ParticipantTimes', 'user_id', 'id');
    }

    public function formatEmails() {
        $emails = $this->github_email;
        if (array_key_exists("public", $emails)) {
            return $emails;
        } else {
            return implode(",", $emails);
        }
    }
}