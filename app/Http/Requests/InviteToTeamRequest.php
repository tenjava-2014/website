<?php namespace TenJava\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use TenJava\User;

class InviteToTeamRequest extends FormRequest {

    /**
     * @var \TenJava\User
     */
    private $user;
    /**
     * @var \TenJava\Team
     */
    private $team;

    public function __construct() {
        $this->user = Auth::user();
        $this->team = $this->user->team;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return $this->team->leader_id === $this->user->id && $this->team->members->count() < 5;
    }

    public function forbiddenResponse() {
        return $this->response(['You are not the team leader or have reached the limit for members.']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        // TODO: Find a better way
        $not_in = implode(',', $this->team->members->lists('username'));
        $not_in .= ',' . implode(',', $this->team->invites->lists('username'));
        $not_in .= ',' . implode(',', $this->team->requests->lists('username'));
        $not_in .= ',' . implode(',', User::whereNotNull('team_id')->lists('username'));
        return [
            'invitee' => 'required|exists:users,username|not_in:' . $not_in
        ];
    }

}
