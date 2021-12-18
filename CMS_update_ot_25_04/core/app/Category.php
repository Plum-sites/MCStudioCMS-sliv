<?php

namespace App;

use App\Servers;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	protected $table = "categories";

	protected $fillable = [
    	'name',
    	'description',
    	'server_id',
    	'status'
    ];

    public function servers() {
        return $this->belongsTo(Servers::class, 'server_id', 'id');
    }

}
