<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Crypt;
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'referral_id',
        'api_token',
        'confirmation_code',
        'status',
        'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function roles() {

        return $this->belongsToMany('App\Role','user_group', 'user_id', 'role_id');

    }

    

    public function getPassdecryptedAttribute() {

        return Crypt::decrypt($this->password);

    }

    public static function GenToken() {

        return str_random(32);
        
    }

    public static function GenConfirmationCode() {
        return str_random(32);
    }
}
