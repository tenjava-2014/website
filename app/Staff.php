<?php namespace TenJava;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * TenJava\Staff
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $user_id
 * @property integer $status
 * @property-read \TenJava\User $user
 * @property-read mixed $username
 * @property-read \Illuminate\Database\Eloquent\Collection|\$related[] $morphedByMany
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Staff whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Staff whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Staff whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Staff whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Staff whereStatus($value)
 * @method static Builder judge()
 * @method static Builder organizer()
 * @method static Builder webTeam()
 * @property-read \Illuminate\Database\Eloquent\Collection|\TenJava\Team[] $claims
 */
class Staff extends Model {
    const JUDGE_BIT = 1;
    const WEB_TEAM_BIT = 2;
    const ORGANIZER_BIT = 4;
    protected $table = 'staff';
    protected $guarded = ['id', 'updated_at', 'created_at'];
    protected $visible = ['id', 'updated_at', 'created_at', 'username', 'status'];
    protected $appends = ['username'];

    public function claims() {
        return $this->hasMany('\TenJava\Team', 'claimed_by');
    }

    public function getUsernameAttribute() {
        return $this->user->username;
    }

    public function isJudge() {
        return $this->status & self::JUDGE_BIT;
    }

    public function isOrganizer() {
        return $this->status & self::ORGANIZER_BIT;
    }

    public function isWebTeam() {
        return $this->status & self::WEB_TEAM_BIT;
    }

    public function scopeJudge(Builder $query) {
        return $query->where('status', '&', self::JUDGE_BIT);
    }

    public function scopeOrganizer(Builder $query) {
        return $query->where('status', '&', self::ORGANIZER_BIT);
    }

    public function scopeWebTeam(Builder $query) {
        return $query->where('status', '&', self::WEB_TEAM_BIT);
    }

    public function setJudge($judge) {
        $this->setStatus(self::JUDGE_BIT, $judge);
    }

    private function setStatus($bit, $status) {
        if ($status) {
            $this->status |= $bit;
        } else {
            $this->status &= ~$bit;
        }
        $this->save();
    }

    public function setOrganizer($organizer) {
        $this->setStatus(self::ORGANIZER_BIT, $organizer);
    }

    public function setWebTeam($webTeam) {
        $this->setStatus(self::WEB_TEAM_BIT, $webTeam);
    }

    public function user() {
        return $this->belongsTo('\TenJava\User');
    }
}
