<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GatewayTransact extends Model {
    protected $table = 'gateway_transact';
    protected $guarded = ['id'];
    protected $fillable = [
		'user_id',
		'gateway',
		'amount',
		'user_balance',
		'charge',
		'type',
		'trx'
	];

    public function gateway() {
        return $this->belongsTo(Gateway::class, 'gateway_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function usergateway() {
        return $this->belongsTo(User::class, 'gateway', 'username');
    }
}
