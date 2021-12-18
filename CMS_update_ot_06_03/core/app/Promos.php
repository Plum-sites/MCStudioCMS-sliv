<?php

namespace App;

use App\Servers;

use Illuminate\Database\Eloquent\Model;

class Promos extends Model {

    protected $table = "promos";

    protected $guarded = ['id'];

    protected $fillable = [
        'status'
    ];
    
    public $timestamps = FALSE;
}
