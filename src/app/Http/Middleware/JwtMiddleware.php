<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Http\Request;

class JwtMiddleware
{

    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->header('Authentication'); 

        if(!$token) {
            // Unauthorized response if token not there
            return response()->json('Session token not provided', HttpResponse::HTTP_UNAUTHORIZED);
        }

        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch(ExpiredException $e) {
            return response()->json('Invalid session token', HttpResponse::HTTP_BAD_REQUEST);
        } catch(Exception $e) {
            return response()->json('Invalid session token', HttpResponse::HTTP_BAD_REQUEST);
        }

        $user = User::find($credentials->sub);

        // Now let's put the user in the request class so that you can grab it from there
        $request->auth = $user;
        return $next($request);
    }

}
