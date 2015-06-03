<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'name' => array('required' , 'min:3', 'regex:/^[a-zA-Z ]+$/'),
            //'email' => 'required|email|unique:users,email',
            'email' => 'required|email',
            'alt_email' => 'email|unique:users, alt_email',
            'password' => 'required|min:8|confirmed',
            //'institution_id' => 'required|not_in:default',
            'photo_url' => 'min:3',
            'profile_url' => 'min:3',
            'position' => 'required|min:3',
            'flags' => 'required|numeric',
            'role' => 'required|numeric',
		];
	}

}
