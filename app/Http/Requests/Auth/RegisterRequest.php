<?php namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class RegisterRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'lastname' => 'required|max:30',
			'firstname' => 'required|max:30',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|min:5',
            'number' => 'required|min:5',
            'lang' => 'required',
            'lat' => 'required',
            'lng' => 'required',
			'sub1' => 'required',
			'sub2' => 'required',
			'city' => 'required'
		];
	}

}
