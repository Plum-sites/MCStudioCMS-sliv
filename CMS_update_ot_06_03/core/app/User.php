<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function transaction(){
        return $this->hasMany(Transaction::class);
    }

    public function isAdmin($username) {
        $admin = Admin::where('username', @$username)->first();
        if(@$admin->id) {
            return true;
        }
        return false;
    }
}
