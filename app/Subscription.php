<?php
namespace TenJava;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscription
 *
 * @package TenJava\Models
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $gh_id
 * @property string $gh_username
 * @property string $email
 * @property boolean $confirmed
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Subscription whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Subscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Subscription whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Subscription whereGhUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Subscription whereGhId($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Subscription whereConfirmed($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\$related[] $morphedByMany
 */
class Subscription extends Model {
    protected $table = 'subscriptions';
    protected $guarded = ['id', 'updated_at', 'created_at'];
    protected $hidden = ['email'];
}
