<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'code'
    ];

    public function users() {

        return $this->belongsToMany('App\User','user_group','role_id','user_id');

    }

    public function scopeAdmin($query) {

        return $query->where('code','admin');

    }

    public function scopeMember($query) {
        return $query->where('code','member');
    }
}