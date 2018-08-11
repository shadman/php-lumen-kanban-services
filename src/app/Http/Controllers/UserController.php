<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Facade\UserFacade;
use App\Validators\UserValidator;

class UserController extends Controller
{

    /**
     * Create user
     * 
     * @param  \App\Models\User $request 
     * @return json
     */
    public function create(Request $request){

        $parameters = $request->json()->all();

        $validator = UserValidator::registration($parameters);
        if (!$validator->fails()) {
            return UserFacade::create($parameters);
        }

        // Bad Request response
        return response()->json('Input validation failed', HttpResponse::HTTP_BAD_REQUEST);
        
    }

}
