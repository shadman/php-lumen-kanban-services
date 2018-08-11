<?php

namespace App\Validators;

use Validator;
use App\Models\User;

class UserValidator
{


    public static function registration($parameters)
    {
        $rules =  array(
            'email'    => 'required|email',
            'username' => 'required',
            'password' => 'required|min:4'
        );
        
        return Validator::make($parameters, $rules);
    }

}
