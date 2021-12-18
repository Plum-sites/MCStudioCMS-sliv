<?php

namespace App;

use App\Servers;
use App\Category;

use Illuminate\Database\Eloquent\Model;

class Items extends Model {

    protected $table = "items";

    protected $guarded = ['id'];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function servers() {
        return $this->belongsTo(Servers::class, 'server_id', 'id');
    }

}
