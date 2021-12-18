<?php

namespace App;

use App\Servers;

use Illuminate\Database\Eloquent\Model;

class Kits extends Model {

    protected $table = "kits";

    protected $guarded = ['id'];

    protected $fillable = [
        'status'
    ];

    public function servers() {
        return $this->belongsTo(Servers::class, 'server_id', 'id');
    }

}
