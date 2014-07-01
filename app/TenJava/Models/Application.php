<?php
namespace TenJava\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * TenJava\Models\Application
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $gh_username
 * @property string $dbo_username
 * @property string $irc_username
 * @property string $mc_username
 * @property string $gmail
 * @property boolean $judge
 * @property string $github_email
 * @property string $twitch_username
 * @property integer $gh_id
 * @property-read ParticipantTimes $timeEntry
 */
class Application extends Model {

    protected $visible = ["gh_username","timeEntry"];

    public function timeEntry() {
        /* @see \TenJava\Models\ParticipantTimes */
        return $this->hasOne('\\TenJava\\Models\\ParticipantTimes', 'user_id', 'id');
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