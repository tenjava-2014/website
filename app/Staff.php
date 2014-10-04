<?php namespace TenJava;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model {
    protected $table = 'staff';
    protected $guarded = ['id', 'updated_at', 'created_at'];
    const JUDGE_BIT = 1;
    const WEB_TEAM_BIT = 2;
    const ORGANIZER_BIT = 4;

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

    public function getUsernameAttribute() {
        return $this->user->username;
    }
}
