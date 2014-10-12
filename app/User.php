<?php namespace TenJava;

use Illuminate\Auth\UserTrait;
use Illuminate\Contracts\Auth\User as UserContract;
use Illuminate\Database\Eloquent\Model;

/**
 * TenJava\User
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $remember_token
 * @property integer $gh_id
 * @property string $username
 * @property string $name
 * @property string $email
 * @property string $emails
 * @property boolean $allow_email
 * @property string $avatar
 * @property integer $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\TenJava\Invite[] $invites
 * @property-read \Illuminate\Database\Eloquent\Collection|\TenJava\Request[] $requests
 * @property-read \TenJava\Staff $staff
 * @property-read \TenJava\Team $team
 * @property-read \Illuminate\Database\Eloquent\Collection|\$related[] $morphedByMany
 * @method static \Illuminate\Database\Query\Builder|\TenJava\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\User whereGhId($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\User whereEmails($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\User whereAllowEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\User whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\TenJava\User whereTeamId($value)
 */
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

    public function invites() {
        return $this->hasMany('\TenJava\Invite');
    }

    public function link() {
        $safe_username = e($this->username);
        return '<a href="https://github.com/' . $safe_username . '">' . $safe_username . '</a>';
    }

    public function requests() {
        return $this->hasMany('\TenJava\Request');
    }

    public function setOptoutStatus($optout) {
        $this->allow_email = !$optout;
        $this->save();
    }

    public function setTeam(Team $team) {
        $this->team_id = $team->id;
        foreach ($this->requests as $request) {
            $request->delete();
        }
        foreach ($this->invites as $invite) {
            $invite->delete();
        }
        $this->save();
    }

    public function staff() {
        return $this->hasOne('\TenJava\Staff');
    }

    public function team() {
        return $this->belongsTo('\TenJava\Team');
    }

}
