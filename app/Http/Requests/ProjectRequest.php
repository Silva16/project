<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProjectRequest extends Request {

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
            //'name' => array('required' , 'min:3', 'regex:/^[a-zA-Z ]+$/'),
            'name' => 'required|min:3',
            'type' => 'required|min:3',
            'description' => 'required|min:10',
            'keywords' => 'min:3',
            'theme' => 'required|min:3',
            'started_at' => 'required|after:01 January 1987|before:now',
            'featured_until' => 'required|after:01 January 1987|before:now',
            'finished_at' => 'after:01 January 1987|before:now',
            'state' => 'required|not_in:default',
            'used_software' => 'min:3',
            'used_hardware' => 'min:3',
            'observations' => 'min:10'
		];
	}

}
