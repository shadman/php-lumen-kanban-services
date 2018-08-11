<?php

namespace App\Facade;

use Illuminate\Http\Response as HttpResponse;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;


class AuthFacade
{

	/**
     * Authenticate user credentials.
     * 
     * @param  \App\Request $request
     * @return object
     */
    public static function authenticate($request)
    {

		$user = User::is_username_exists($request->input('username'));
		if (!$user) {
		    return response()->json('Invalid username/password supplied', HttpResponse::HTTP_BAD_REQUEST);
		}

		// Verify the password and generate the token
		if (Hash::check($request->input('password'), $user->password)) {
		    return response()->json([
		    	'sessionToken' => self::jwt($user), 
		    	'id' => $user->id,
		    ], HttpResponse::HTTP_OK);
		}
    }


    /**
     * Create a new token.
     * 
     * @param  \App\Models\User $user
     * @return string
     */
    protected static function jwt(User $user) {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued. 
            'exp' => time() + 60*60 // Expiration time
        ];
        
        // As you can see we are passing `JWT_SECRET` as the second parameter that will 
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    } 
    

}
