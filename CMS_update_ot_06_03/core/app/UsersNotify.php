<?php

namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;

class UsersNotify extends Model {

    protected $table = "users_notify";

    protected $fillable = [
    	'user_id',
    	'subject',
    	'message',
    	'sender_id',
    	'notify_type',
    	'timeout',
    	'type',
    	'status'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

}
