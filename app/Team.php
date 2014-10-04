<?php namespace TenJava;

use Illuminate\Database\Eloquent\Model;

/**
 * TenJava\Team
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $name
 * @property integer $leader_id
 * @property string $general_rules
 * @property string $prize_rules
 * @property string $miscellaneous_rules
 * @property-read \TenJava\User $leader
 * @property-read \Illuminate\Database\Eloquent\Collection|\TenJava\User[] $members
 * @property-read \Illuminate\Database\Eloquent\Collection|\$related[] $morphedByMany
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Team whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Team whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Team whereLeaderId($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Team whereGeneralRules($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Team wherePrizeRules($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Team whereMiscellaneousRules($value)
 */
class Team extends Model {
    protected $table = 'teams';
    protected $guarded = ['id', 'updated_at', 'created_at'];

    public function leader() {
        return $this->belongsTo('\TenJava\User', 'leader_id');
    }

    public function members() {
        return $this->hasMany('\TenJava\User');
    }

    public function claimedBy() {
        return $this->hasOne('\TenJava\Staff');
    }
}
