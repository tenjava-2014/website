<?php
namespace TenJava\Models;

use Eloquent;

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
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Models\Subscription whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Models\Subscription whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Models\Subscription whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Models\Subscription whereEmail($value) 
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Models\Subscription whereGhUsername($value) 
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Models\Subscription whereGhId($value) 
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Models\Subscription whereConfirmed($value) 
 */
class Subscription extends Eloquent {
    protected $table = 'subscriptions';
    protected $guarded = ['id', 'updated_at', 'created_at'];
    protected $hidden = ['email'];
}
