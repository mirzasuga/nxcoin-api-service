<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\User;
use App\Services\UserService;
use App\Events\UserRegistered;


class RegisterController extends Controller
{

    public function __construct() {

    }

    public function confirm(Request $request) {

    }

}