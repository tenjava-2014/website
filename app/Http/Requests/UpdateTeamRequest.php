<?php namespace TenJava\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamRequest extends FormRequest {

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
        return $this->team->leader_id === $this->user->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|unique:teams,name,' . $this->team->id,
            'description' => 'required',
            'general_rules' => 'required',
            'prize_rules' => 'required',
        ];
    }

}
