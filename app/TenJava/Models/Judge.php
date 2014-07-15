<?php
namespace TenJava\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * TenJava\Models\Judge
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $github_id
 * @property string $github_name
 * @property boolean $admin
 * @property string $minecraft_name
 * @property boolean $web_team
 * @method static Builder|Judge whereId($value)
 * @method static Builder|Judge whereCreatedAt($value)
 * @method static Builder|Judge whereUpdatedAt($value)
 * @method static Builder|Judge whereGithubId($value)
 * @method static Builder|Judge whereGithubName($value)
 * @method static Builder|Judge whereAdmin($value)
 * @method static Builder|Judge whereWebTeam($value)
 */
class Judge extends Model {
    protected $guarded = ['id', 'updated_at', 'created_at'];
    protected $hidden = ['minecraft_username'];

    public function claims() {
        return $this->hasMany("TenJava\\Models\\JudgeClaim", "judge_id", "id");
    }
}