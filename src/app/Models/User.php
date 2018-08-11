<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Hashing\BcryptHasher;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'phone', 'title', 'avatar'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public $timestamps = false;

    /**
     * Create user record
     */
    static public function create_record($parameters) {
        return self::create(
            array(
                'email' => $parameters['email'],
                'username' => $parameters['username'],
                'password' => (new BcryptHasher)->make($parameters['password']),
                'createdAt' => Carbon::now()->toDateTimeString(),
                'avatar' => 'no-image.jpg'
            )
        );        
    }

    /**
     * If user already exists
     */
    static public function is_user_already_exists($parameters){
        return User::where('email', $parameters['email'])->orWhere('username', $parameters['username'])->first();     
    }

    /**
     * If user name already exists
     */
    static public function is_username_exists($username){
        return  User::where('username', $username)->first();
    }
    
}
