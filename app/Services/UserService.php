<?php

namespace App\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\User;
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

}