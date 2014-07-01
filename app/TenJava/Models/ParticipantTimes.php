<?php
namespace TenJava\Models;

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
 */
class ParticipantTimes extends Model {
    protected $table = 'participant_times';
    protected $visible = ["t1","t2","t3"];
}