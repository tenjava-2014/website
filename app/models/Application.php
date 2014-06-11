<?php


class Application extends \Illuminate\Database\Eloquent\Model {

    public function timeEntry() {
        return $this->hasOne('ParticipantTimes', 'user_id', 'id');
    }

    public function formatEmails() {
        $emails = json_decode($this->github_email, true);
        if (array_key_exists("public", $emails)) {
            return $this->github_email;
        } else {
            return implode(", ", $emails);
        }
    }

    public static function search($keywords) {

        $return = Application::query();
        foreach($keywords as $keyword) {
            $return->where(function($query) use($keyword) {
                $like = "%" . $keyword . "%";
                $query->orWhere('gh_username', 'LIKE', $like);
                $query->orWhere('dbo_username', 'LIKE', $like);
                $query->orWhere('github_email', 'LIKE', $like);
                $query->orWhere('irc_username', 'LIKE', $like);
                $query->orWhere('mc_username', 'LIKE', $like);
            });
        }
        return $return;
    }
}