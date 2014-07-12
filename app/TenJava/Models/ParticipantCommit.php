<?php
namespace TenJava\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * TenJava\Models\ParticipantCommit
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $message
 * @property string $hash
 * @property integer $app_id
 * @property string $repo
 */
class ParticipantCommit extends Model {
    // Quite happy to show this all as JSON
    protected $table = 'participant_commits';
}