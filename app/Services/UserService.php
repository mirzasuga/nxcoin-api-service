<?php

namespace App\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Crypt;
class UserService
{
    protected $user;


    public static function attempLogin(Request $request) {

        $username = $request->username;
        $password = $request->password;
        
        $user = User::where('username',$username)->first();
        


        if( !$user || $user->passdecrypted !== $password ) {
            
            throw new ModelNotFoundException('username or password incorect',404);

        }

        return $user;
    }

    public static function store(Request $request) {

        $user = new User();
        $role = Role::member()->first();
        $user->name                 = $request->name;
        $user->username             = $request->username;
        $user->email                = $request->email;
        $user->password             = Crypt::encrypt($request->password);
        $user->api_token            = User::GenToken();
        $user->confirmation_code    = User::GenConfirmationCode();
        
        if(!$user->save()) throw new HttpException('Registration failed', 500);
        
        $user->roles()->attach($role->id);

        return $user;
        
    }

}