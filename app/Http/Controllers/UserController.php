<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\User;
use App\Services\UserService;
use App\Events\UserRegistered;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function login(Request $request) {

        $user = UserService::attempLogin($request);
        
        return response()->json([
            'status' => 1,
            'data' => ['user' => $user]
        ]);
        

    }

    public function store(Request $request) {
        
        /**
         * check RegisterMiddleware for validating refferal
         */
        $starttime = microtime(true);

        $this->validate($request, [

            'name'          => 'required',
            'username'      => 'required|unique:users',
            'password'      => 'required|min:6',
            'email'         => 'required|email|unique:users'
        
        ]);
        
        $user = UserService::store($request);
        
        event( new UserRegistered($user) );
        
        $endtime = microtime(true);

        $timediff = $endtime - $starttime;

        return response()->json([

            'status' => 1,
            'data' => [
                'user' => $user
            ],
            'message' => 'register success',
            'execution_time' => $timediff

        ]);

    }

    public function view($id) {
        
    }

    public function list(Request $request) {
        
        return response()->json([
            'status' => 1,
            'data' => [
                'users' => User::get()
            ]
        ]);
        
    }

    public function banned($id) {

    }

    public function activate($activationCode) {

    }
}
