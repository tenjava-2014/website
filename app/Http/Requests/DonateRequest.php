<?php namespace TenJava\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use TenJava\Util\EmailUtil;

class DonateRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return Auth::check();
    }

    public function forbiddenResponse() {
        return $this->response(['You must be logged in to donate.']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required',
            'email' => 'required|email|in:' . implode(',', EmailUtil::getEmails() ? : [$this->request->get('email')]),
            'amount' => 'required|numeric|min:0.50',
            'agreement' => 'accepted',
            'terms' => 'accepted',
            'stripeToken' => 'required'
        ];
    }

}
