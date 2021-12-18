<?php

namespace App;

use App\User;
use App\Servers;
use App\Privileges;

use Illuminate\Database\Eloquent\Model;

class UsersPrivileges extends Model {

    protected $table = "users_privileges";

    protected $fillable = [
    	'user_id',
    	'server_id',
    	'privilege_id',
    	'privilege_term',
    	'privilege_price',
    	'status'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function servers() {
        return $this->belongsTo(Servers::class, 'server_id', 'id');
    }

    public function privileges() {
        return $this->belongsTo(Privileges::class, 'privilege_id', 'id');
    }

}
