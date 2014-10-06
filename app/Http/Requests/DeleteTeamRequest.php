<?php namespace TenJava\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class DeleteTeamRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        /** @var $user \TenJava\User */
        $user = Auth::user();
        if ($user->team === null) return false;
        return $user->team->leader_id === $user->id;
    }

    /**
     * When authorization fails.
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function forbiddenResponse() {
        return $this->response(['You cannot delete a team you are not the leader of.']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'delete' => 'accepted'
        ];
    }

}
