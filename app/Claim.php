<?php namespace TenJava;

use Illuminate\Database\Eloquent\Model;

/**
 * TenJava\Claim
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $staff_id
 * @property integer $team_id
 * @property-read \TenJava\Staff $staff
 * @property-read \TenJava\Team $team
 * @property-read \Illuminate\Database\Eloquent\Collection|\$related[] $morphedByMany
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Claim whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Claim whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Claim whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Claim whereStaffId($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Claim whereTeamId($value)
 */
class Claim extends Model {
    protected $table = 'claims';
    protected $guarded = ['id', 'updated_at', 'created_at'];
    protected $visible = ['id', 'team'];

    public function staff() {
        return $this->belongsTo('\TenJava\Staff');
    }

    public function team() {
        return $this->belongsTo('\TenJava\Team');
    }
}
