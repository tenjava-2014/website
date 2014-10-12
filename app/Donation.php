<?php namespace TenJava;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * TenJava\Donation
 *
 * @property-read \TenJava\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\$related[] $morphedByMany
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $user_id
 * @property integer $amount
 * @property boolean $hidden
 * @property boolean $to_organizers
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Donation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Donation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Donation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Donation whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Donation whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Donation whereHidden($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Donation whereToOrganizers($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Donation visible()
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Donation notToOrganizers()
 * @property boolean $fee_applied
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Donation whereFeeApplied($value)
 */
class Donation extends Model {
    protected $table = 'donations';
    protected $guarded = ['id', 'updated_at', 'created_at'];

    public function scopeNotToOrganizers(Builder $query) {
        return $query->whereToOrganizers(false);
    }

    public function scopeVisible(Builder $query) {
        return $query->whereHidden(false);
    }

    public function user() {
        return $this->belongsTo('TenJava\User');
    }
}
