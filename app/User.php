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
    protected $hidden = ['password', 'remember_token', 'email', 'emails'];

    public function staff() {
        return $this->belongsTo('\TenJava\Staff');
    }

    public function getEmails() {
        return json_decode($this->emails);
    }

    /**
     * True if opted-out. False if not.
     * @return boolean
     */
    public function getOptoutStatus() {
        return !$this->allow_email;
    }

    public function setOptoutStatus($optout) {
        $this->allow_email = !$optout;
        $this->save();
    }

}
