<?php namespace TenJava\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use TenJava\Team;

class CreateTeamRequest extends FormRequest {

    /**
     * @var \TenJava\User
     */
    private $user;

    public function __construct() {
        $this->user = Auth::user();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return $this->user->staff === null && Team::whereLeaderId(Auth::id())->count() < 1;
    }

    /**
     * When authorization fails.
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function forbiddenResponse() {
        return $this->response([$this->user->staff === null ? 'You have already created a team.' : 'Staff cannot create teams.']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|unique:teams,name',
            'description' => 'required',
            'general_rules' => 'required',
            'prize_rules' => 'required',
        ];
    }

}
