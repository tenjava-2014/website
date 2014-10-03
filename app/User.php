<?php namespace TenJava;

use Illuminate\Auth\UserTrait;
use Illuminate\Contracts\Auth\User as UserContract;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements UserContract {

    use UserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'email'];

}
