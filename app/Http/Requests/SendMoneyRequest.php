<?php namespace TenJava\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class SendMoneyRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return Auth::check();
    }

    public function forbiddenResponse() {
        return $this->response(['You must be logged in to send money.']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'amount' => 'required|numeric|min:0.50',
            'confirmation' => 'accepted',
            'terms' => 'accepted',
            'stripeToken' => 'required'
        ];
    }

}
