<?php

namespace App;

use App\User;
use App\Servers;

use Illuminate\Database\Eloquent\Model;

class Privileges extends Model {

    protected $table = "privileges";
    
    protected $guarded = ['id'];

    // protected $fillable = [
    // 	'user_id',
    // 	'server_id',
    // 	'privilege_id',
    // 	'privilege_term',
    // 	'privilege_term',
    // 	'status'
    // ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function servers() {
        return $this->belongsTo(Servers::class, 'server_id', 'id');
    }

}
