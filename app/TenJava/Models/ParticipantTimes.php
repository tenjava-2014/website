<?php
namespace TenJava\Models;

use HTML;
use Illuminate\Database\Eloquent\Model;

/**
 * TenJava\Models\ParticipantTimes
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $user_id
 * @property boolean $t1
 * @property boolean $t2
 * @property boolean $t3
 * @property Application appEntry
 */
class ParticipantTimes extends Model {
    protected $table = 'participant_times';
    protected $visible = ["t1", "t2", "t3"];

    public function appEntry() {
        return $this->belongsTo("\\TenJava\\Models\\Application", "id", "user_id");
    }

    public function getTimesLinks($n) {
        if ($this->t{$n}) {
            return HTML::link("https://www.github.com/tenjava/" . $this->appEntry->gh_username . "-t$n", "Time $n") .
            " (" . HTML::link("https://www.github.com/tenjava/" . $this->appEntry->gh_username . "-t$n/commits/", "commits") . ")";
        } else {
            return "";
        }
    }
}