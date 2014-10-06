<?php namespace TenJava;

use Illuminate\Database\Eloquent\Model;

/**
 * TenJava\Request
 *
 * @property-read mixed $username
 * @property-read \TenJava\Team $team
 * @property-read \TenJava\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\$related[] $morphedByMany
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $user_id
 * @property integer $team_id
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Request whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Request whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Request whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Request whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Request whereTeamId($value)
 */
class Request extends Model {
    protected $table = 'requests';
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
