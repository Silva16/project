<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;

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
        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'name' => array('required' , 'min:3', 'regex:/^[a-zA-Z ]+$/'),
                    'email' => 'required|email|unique:users,email',
                    'alt_email' => 'email|unique:users,alt_email',
                    'password' => 'required|min:8|confirmed',
                    'id' => 'required|not_in:default',
                    'photo_url' => 'mimes:png,jpeg,bmp,jpg',
                    'profile_url' => 'min:8',
                    'position' => 'required|min:3',
                    'status' => 'required|numeric',
                    'role' => 'required|not_in:default|min:1|max:3|size:1'
                ];
            }
            case 'PATCH':
            {
                return [
                    'name' => array('required' , 'min:3', 'regex:/^[a-zA-Z ]+$/'),
                    'email' => 'required|email|unique:users,email,'.$this->segment(2),
                    'alt_email' => 'email|unique:users,alt_email,'.$this->segment(2),
                    'password' => 'min:8|confirmed',
                    'id' => 'required|not_in:default',
                    'photo_url' => 'mimes:png,jpeg,bmp,jpg',
                    'profile_url' => 'min:8',
                    'position' => 'required|min:3',
                    'status' => 'required|numeric',
                    'role' => 'required|not_in:default|min:1|max:3|size:1'
                ];
            }
            default:break;
        }
	}

}
