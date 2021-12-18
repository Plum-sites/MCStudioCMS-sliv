<?php

namespace App;

use DB;
use Auth;
use App\User;
use App\ServersDB;
use App\Privileges;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;


class Servers extends Model {

    protected $table = "servers";

    protected $fillable = [
    	'name',
    	'ip',
    	'port',
    	'mysql_host',
    	'mysql_port',
    	'mysql_user',
    	'mysql_base',
    	'mysql_pass',
    	'mysql_table_bans',
    	'mysql_table_coin',
    	'mysql_table_shop',
    	'mysql_table_pref',
    	'status'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'uuid', 'uuid');
    }

    public function privileges() {
        return $this->belongsTo(Privileges::class, 'id', 'server_id');
    }

    ##################################################################

	public static function servers() {
        $servers = self::get();
        foreach($servers as $server) {
        	Config::set('database.connections.server_'.$server->id, [
		        'driver' => 'mysql',
		        'host' => $server->mysql_host,
		        'port' => $server->mysql_port,
		        'database' => $server->mysql_base,
		        'username' => $server->mysql_user,
		        'password' => $server->mysql_pass,
		        'unix_socket' => env('DB_SOCKET', ''),
		        'charset' => 'utf8mb4',
		        'collation' => 'utf8mb4_unicode_ci',
		        'prefix' => '',
		        'strict' => true,
		        'engine' => null,
		    ]);
        }
        // return $this->serverDB;
	}

	public static function server($serverID) {
		$serversDB = new ServersDB('litebans_bans', 'server_'.$serverID);
		$sad = $serversDB->where('id', 1)->first();
		return @$sad->uuid;
	}

	public static function banlist($serverID) {
		$result = [];
		$server = self::where('id', '=', $serverID)->first();
		if(@$server->id) {
			$serverDB = new ServersDB(@$server->mysql_table_bans, 'server_'.@$server->id);
			$banlist = $serverDB->get();
			foreach($banlist as $array) {
				$result[] = $array;
			}
			return $result;
		}
	}

	public static function balance($serverID) {
		$server = self::where('id', '=', $serverID)->first();
		if(@$server->id) {
			@$serverDB = new ServersDB(@$server->mysql_table_coin, 'server_'.@$server->id);
			$balance_real = @User::where('uuid', '=', @Auth::user()->uuid)->first();
			$balance_game = @$serverDB->where('uuid', '=', @Auth::user()->uuid)->first();
			$balance = array(
				'balance_game' => @$balance_game->money,
				'balance_real' => @$balance_real->balance_real
			);
			return $balance;
		}
	}
    
}
