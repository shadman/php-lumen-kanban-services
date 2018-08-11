<?php

namespace App\Validators;

use Validator;
use App\Models\User;

class AuthValidator
{

    public static function authentication($request)
    {

		$parameters = array(
			'username' => $request->input('username'),
			'password' => $request->input('password'),
		);

        $rules =  array(
            'username' => 'required',
            'password' => 'required|min:4'
        );
        
        return Validator::make($parameters, $rules);
    }

}
