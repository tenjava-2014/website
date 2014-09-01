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
        return $this->belongsTo("\\TenJava\\Models\\Application", "user_id", "id");
    }

    public function getApplicableTimes($prefix = null) {
        $arr = [];
        for ($i = 1; $i <= 3; $i++) {
            if ($this->{"t" . $i}) {
                $arr[] = ($prefix != null) ? $prefix . "t" . $i : "t" . $i;
            }
        }
        return $arr;
    }

    public function getTimesLinks($n) {
        if ($this->{"t" . $n}) {
            $concatName = $this->appEntry->gh_username . "-t$n";
            return HTML::link("https://www.github.com/tenjava/" . $concatName, "Time $n") .
            " (" . HTML::link("https://www.github.com/tenjava/" . $concatName . "-t$n/commits/", "commits") . ", ".
            HTML::link("/judging/results-viewer/" . $concatName, "results") .")";
        } else {
            return "";
        }
    }
}