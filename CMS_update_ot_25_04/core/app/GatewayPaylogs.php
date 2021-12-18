<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GatewayPaylogs extends Model {

	protected $table = "gateway_paylogs";
	protected $fillable = [
		'user_id',
		'money',
		'bonus',
		'system',
		'status'
	];

	public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}

?>