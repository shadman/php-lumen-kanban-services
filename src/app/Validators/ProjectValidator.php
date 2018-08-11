<?php

namespace App\Validators;

use Validator;
use App\Models\User;

class ProjectValidator
{


    public static function create($parameters)
    {
        $rules =  array(
            'name'    => 'required|max:200'
        );
        
        return Validator::make($parameters, $rules);
    }

}
