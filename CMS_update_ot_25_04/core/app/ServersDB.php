<?php

namespace App;

use DB;
use Auth;
use App\User;
use App\Servers;
use Illuminate\Database\Eloquent\Model;

class ServersDB extends Model {

    public $table = "";
    public $connection = '';

    protected $fillable = [
    	'purchase'
    ];

    function __construct($table, $connection = 'mysql') {
    	$this->table = $table;
		$this->connection = $connection;
	}

    public function useruuid() {
		$this->connection = 'mysql';
        return $this->belongsTo(User::class, 'uuid', 'uuid');
    }

    public function adminuuid() {
		$this->connection = 'mysql';
        return $this->belongsTo(User::class, 'banned_by_uuid', 'uuid');
    }

	public function banlist() {
		$result = [];
		$banlist = self::get();
		foreach ($banlist as $array) {
			$result[] = $array;
		}
		return $result;
	}
    
}
