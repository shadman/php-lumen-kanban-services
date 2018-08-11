<?php

namespace App\Facade;

use Illuminate\Http\Response as HttpResponse;
use App\Models\User;

class UserFacade
{

    public static function create($parameters)
    {

        $user = User::is_user_already_exists($parameters);
        if (!$user) {
            $createdUser = User::create_record($parameters);
            return response()->json($createdUser, HttpResponse::HTTP_CREATED);
        }
        
        return response()->json('Either username or email already exists', HttpResponse::HTTP_CONFLICT);        

    }


}
