<?php namespace TenJava;

use Illuminate\Database\Eloquent\Model;

/**
 * TenJava\Invite
 *
 * @property-read \TenJava\Team $team
 * @property-read \TenJava\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\$related[] $morphedByMany
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $user_id
 * @property integer $team_id
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Invite whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Invite whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Invite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Invite whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Invite whereTeamId($value)
 * @property-read mixed $username
 */
class Invite extends Model {
    protected $table = 'invites';
    protected $guarded = ['id', 'updated_at', 'created_at'];
    protected $appends = ['username'];

    public function getUsernameAttribute() {
        return $this->user->username;
    }

    public function team() {
        return $this->belongsTo('\TenJava\Team');
    }

    public function user() {
        return $this->belongsTo('\TenJava\User');
    }
}
