<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Image;
use Session;

use App\User;
use App\UserAuth;
use App\UsersNotify;
use App\UsersPrivileges;
use App\UsersPrefixes;
use App\UsersRatings;
use App\Servers;
use App\ServersDB;
use App\Privileges;
use App\Kits;

use App\Items;
use App\Category;
use App\GatewayUnitpay;
use App\GatewayFreekassa;
use App\GatewayTransact;
use App\GatewayPaylogs;
use App\GeneralSetting;
use App\Http\Lib\MinecraftQuery;
use App\Http\Lib\MinecraftPing;

use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\MailerController;
use Illuminate\Support\Facades\Hash;

class CronController extends Controller {

	public function __construct() {
        session_start();
        Servers::servers();
        $this->general = GeneralSetting::first();
    }

    public function hasherstring($string = 'default') {
        $hash = md5(md5($string.":".time()).":".md5($string.":".str_random(32)));
        $hash = substr($hash, 0, 16);
        return $hash;
    }

    public function news() {
        $get_link = "https://api.vk.com/method/wall.get";
        $get_news = file_get_contents($get_link."?from_group=1&extended=1&owner_id=-".@$this->general->vk_group_id."&count=".@$this->general->vk_output_count."&v=5.124&access_token=".@$this->general->vk_group_token);
        $get_news = json_decode($get_news);
        $get_news = json_encode($get_news, JSON_PRETTY_PRINT);
        $put_news = file_put_contents($_SERVER['DOCUMENT_ROOT']."/news.json", $get_news);
        return "[".date("d.m.Y H:i", time())."] News updated";
    }

    // public function monitoring() {
    //     $updated = 0;
    //     $servers = Servers::where('status', '=', 1)->get();
    //     foreach($servers as $server) {
    //         $serverQuery = new MinecraftQuery((@$server->ip == '0' || @$server->ip == '1') ? '127.0.0.1' : $server->ip, (@$server->port == '0' || @$server->port == '1') ? '25565' : $server->port, 10);
    //         if($serverQuery->connect()) {
    //             $serverInfo = $serverQuery->get_info();
    //             if($serverInfo['numplayers'] > $server->max_online) {
    //                 $server->max_online = $serverInfo['numplayers'];
    //             }
    //             if(@$serverInfo['numplayers']) {
    //                 $server->online = $serverInfo['numplayers'];
    //             }
    //             if(@$serverInfo['maxplayers']) {
    //                 $server->slots = $serverInfo['maxplayers'];
    //             }
    //             $server->save();
    //             $updated++;
    //         }
    //     }
    //     if($updated >= 1) {
    //         $data = array(
    //             'type' => 'success',
    //             'message' => 'Successfully updated '.$updated.' servers'
    //         );
    //         return response()->json($data);
    //     } else {
    //         $data = array(
    //             'type' => 'warning',
    //             'message' => 'Servers not updated is connection failed'
    //         );
    //         return response()->json($data);
    //     }
    // }

    public function monitoring() {
        $updated = 0;
        $servers = Servers::where('status', '=', 1)->get();
        foreach($servers as $server) {
            $serverQuery = new MinecraftPing((@$server->ip == '0' || @$server->ip == '1') ? '127.0.0.1' : $server->ip, (@$server->port == '0' || @$server->port == '1') ? '25565' : $server->port, 10);

            if($serverQuery->Connect()) {
                $serverInfo = $serverQuery->Query();
                if($serverInfo['players']['online'] > $server->max_online) {
                    $server->max_online = $serverInfo['players']['online'];
                }
                if(@$serverInfo['players']['online']) {
                    $server->online = $serverInfo['players']['online'];
                }
                if(@$serverInfo['players']['max']) {
                    $server->slots = $serverInfo['players']['max'];
                }
                $server->save();
                $updated++;
            }
            else {
                $server->online = 0;
                $server->slots = 0;
                $server->save();

                $data = array(
                    'type' => 'warning',
                    'message' => 'Servers not updated is connection failed (Ping)'
                );
                return response()->json($data);
            }
        }
        if($updated >= 1) {
            $data = array(
                'type' => 'success',
                'message' => 'Successfully updated '.$updated.' servers'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Servers not updated is connection failed'
            );
            return response()->json($data);
        }
    }

    public function privileges() {
        $updated = 0;
        $privileges = UsersPrivileges::where('status', '=', 1)->get();
        foreach($privileges as $key => $privilege) {
            if(time() >= @$privilege->privilege_term && @$privilege->privilege_term != -1) {
                UsersPrivileges::where('id', '=', @$privilege->id)->delete();
                UsersPrefixes::where([
                    ['user_id', '=', @$privilege->user_id],
                    ['server_id', '=', @$privilege->servers->id]
                ])->delete();
                $updated++;
            }
        }
        if($updated >= 1) {
            $data = array(
                'type' => 'success',
                'message' => 'Successfully cleared '.$updated.' privileges'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Privileges not cleared because they are no'
            );
            return response()->json($data);
        }
    }

    public function ratings() {
        $clear = UsersRatings::truncate();
        if(@$clear) {
            $data = array(
                'type' => 'success',
                'message' => 'Successfully cleared votes'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'success',
                'message' => 'Votes not cleared'
            );
            return response()->json($data);
        }
    }

}

?>