<?php
namespace TenJava\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * TenJava\Models\ParticipantAvatar
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $app_id
 * @property string $url
 */
class ParticipantAvatar extends Model {
    protected $table = 'user_avatars';
}