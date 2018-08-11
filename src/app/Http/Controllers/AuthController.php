<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Response as HttpResponse;
use App\Validators\AuthValidator;
use App\Facade\AuthFacade;


class AuthController extends BaseController 
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;


    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }
    
    
    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     * 
     * @param  \App\Models\User $user 
     * @return mixed
     */
    public function authenticate(User $user) {

        $validator = AuthValidator::authentication($this->request);
        if (!$validator->fails()) {
            return AuthFacade::authenticate($this->request);
        }

        // Bad Request response
        return response()->json('Invalid username/password supplied', HttpResponse::HTTP_BAD_REQUEST);
    }

}