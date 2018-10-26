<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Services\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RoleController extends Controller
{

    public function __construct() {
        
        //

    }

    public function addUserRole(Request $request) {

        $this->validate($request, [
            'user_id' => 'required',
            'role_id' => 'required'
        ]);
        $user = null;
        $role = null;
        try {
            
            $user = User::findOrFail($request->user_id);
            $role = Role::findOrFail($request->role_id);

        } catch(ModelNotFoundException $e) {
            
            throw new ModelNotFoundException('User or Role not Found', 404);

        }

        $newRole = null;
        if(!$user->roles->contains($role->id)) {
            
            $user->roles()->attach($role->id);
            $newRole = $role;
        }

        return response()->json([
            'status' => 1,
            'data' => [
                'user' => $user,
                'new_role' => $newRole
            ]
        ]);
    }

}