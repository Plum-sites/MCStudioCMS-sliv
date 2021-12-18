<?php

namespace App;

use App\User;
use App\Servers;

use Illuminate\Database\Eloquent\Model;

class UsersPrefixes extends Model {

    protected $guarded = ['id'];

    protected $table = "users_prefixes";

    // protected $fillable = [
    // 	'user_id',
    // 	'server_id',
    // 	'prefix',
    // 	'status'
    // ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function servers() {
        return $this->belongsTo(Servers::class, 'server_id', 'id');
    }

}
