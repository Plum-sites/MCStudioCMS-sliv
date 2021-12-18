<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Image;
use Session;

use App\User;
use App\UsersRatings;
use App\Servers;
use App\GeneralSetting;
use App\RatingsSetting;

use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class VotesController extends Controller {

	public function __construct() {
        session_start();
        $this->general = GeneralSetting::first();
        $this->ratings = RatingsSetting::first();
        $this->service = array(
            'mcrate',
            'topcraft',
            'minecraftrating'
        );
    }

    public function hasherstring($string = 'default') {
        $hash = md5(md5($string.":".time()).":".md5($string.":".str_random(32)));
        $hash = substr($hash, 0, 16);
        return $hash;
    }

    public function service($name, Request $request) {
        if(in_array(@$name, $this->service)) {
            switch(@$name) {
                case 'mcrate':
                    $secret = @$this->ratings->secret_mcrate;
                    $player = @$request->nick;
                    $timestamp = @$request->timestamp;
                    $signature = @$request->hash;
                    if(!@$player || !@$signature) {
                        $data = array(
                            'type' => 'warning',
                            'message' => 'Error: Request params not valid'
                        );
                        return response()->json($data);
                    }

                    if(md5(md5($player.$secret.'mcrate')) != @$signature) {
                        $data = array(
                            'type' => 'warning',
                            'message' => 'Error: Request signature not valid'
                        );
                        return response()->json($data);
                    }
                break;
                case 'topcraft':
                    $secret = @$this->ratings->secret_topcraft;
                    $player = @$request->username;
                    $timestamp = @$request->timestamp;
                    $signature = @$request->signature;
                    if(!@$player || !@$signature || !@$timestamp) {
                        $data = array(
                            'type' => 'warning',
                            'message' => 'Error: Request params not valid'
                        );
                        return response()->json($data);
                    }
                    if(sha1($player.@$timestamp.$secret) != @$signature) {
                        $data = array(
                            'type' => 'warning',
                            'message' => 'Error: Request signature not valid'
                        );
                        return response()->json($data);
                    }
                break;
                case 'minecraftrating':
                    $secret = @$this->ratings->secret_minecraftrating;
                    $player = @$request->username;
                    $timestamp = @$request->timestamp;
                    $signature = @$request->signature;
                    if(!@$player || !@$signature || !@$timestamp) {
                        $data = array(
                            'type' => 'warning',
                            'message' => 'Error: Request params not valid'
                        );
                        return response()->json($data);
                    }
                    if(sha1($player.@$timestamp.$secret) != @$signature) {
                        $data = array(
                            'type' => 'warning',
                            'message' => 'Error: Request signature not valid'
                        );
                        return response()->json($data);
                    }
                break;
            }
            return UsersRatings::rewardSend(@$player);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Error: Service not found in list'
            );
            return response()->json($data);
        }
    } 

}

?>