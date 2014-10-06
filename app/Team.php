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
 * @property-read \TenJava\Staff $claimedBy
 * @property integer $claimed_by
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Team whereClaimedBy($value)
 * @property string $repo_name
 * @property string $description
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Team whereRepoName($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Team whereDescription($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\TenJava\Invite[] $invites
 * @property-read \Illuminate\Database\Eloquent\Collection|\TenJava\Request[] $requests
 */
class Team extends Model {
    protected $table = 'teams';
    protected $guarded = ['id', 'updated_at', 'created_at'];

    public function claimedBy() {
        return $this->belongsTo('\TenJava\Staff', 'claimed_by');
    }

    public function invites() {
        return $this->hasMany('\TenJava\Invite');
    }

    public function leader() {
        return $this->belongsTo('\TenJava\User', 'leader_id');
    }

    public function members() {
        return $this->hasMany('\TenJava\User');
    }

    public function requests() {
        return $this->hasMany('\TenJava\Request');
    }
}
