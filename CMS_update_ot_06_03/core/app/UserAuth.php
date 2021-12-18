<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAuth extends Model {

	protected $table = "users_auth";

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
	
	// protected $fillable = [
	// 	'user_id',
	// 	'user_ip',
	// 	'user_os'
	// ];
	// protected $guarded = ['id']; 

	public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}

?>