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

        $this->validate($request, [
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users'
        ]);
        
        $user = User::create([

            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Crypt::encrypt($request->password),
            'api_token' => User::GenToken(),
            'confirmation_code' => User::GenConfirmationCode(),

        ]);
        
        event( new UserRegistered($user) );

        return response()->json([
            'status' => 1,
            'data' => [
                'user' => $user
            ],
            'message' => 'register success'
        ]);

    }

    public function view($id) {
        
    }

    public function list(Request $request) {

    }

    public function banned($id) {

    }

    public function activate($activationCode) {

    }
}
