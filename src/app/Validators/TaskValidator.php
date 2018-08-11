<?php

namespace App\Validators;

use Validator;
use App\Models\Task;

class TaskValidator
{


    public static function create_update($parameters)
    {
        $rules =  array(
            'title'    => 'required|max:200'
        );
        
        return Validator::make($parameters, $rules);
    }

}
