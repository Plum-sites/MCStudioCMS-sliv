<?php

namespace App\Http\Controllers;

use App\Order;
use App\Service;
use App\ServicePrice;
use App\GatewayTransact;
use App\User;
use App\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;

class ApiController extends Controller {

    public function __construct() {
        session_start();
        $this->general = GeneralSetting::first();
    }

    public function hasherstring($string = 'default') {
        $hash = md5(md5($string.":".time()).":".md5($string.":".str_random(32)));
        $hash = substr($hash, 0, 16);
        return $hash;
    }

    public function gravitAuth(Request $request)
    {
        $password = $request->password;
        $username = $request->username;
        $apikey = $request->apiKey;

        if($apikey != '7p(Pkjv4%7%)9vov') {
            return response()->json(['error' => 'Неверный ключ API']);
        }

        $user = User::where('username', $username)->first();

        if (Hash::check($password, $user->password)) {
            return response()->json(['username' => $username, 'permissions' => 0]);
        }
        else {
            return response()->json(['error' => 'Неверный логин или пароль']);
        }
    }

    public function script(Request $request) {

        $request->action = strtolower(@$request->action);

        if(!isset($request->action)){
            $data['error'] = 'Action should not be empty';
            return response()->json($data);
        }

        if($request->action === 'balance') {
            if(!isset($request->key)) {
                $data['error'] = 'Api Key should not be empty';
                return response()->json($data);
            }
            $user = User::where('api_key', $request->key)->where('status', 1)->latest()->first();
            if(empty($user) || $user->status == 0) {
                $data['error'] = 'Invalid Api key';
                return response()->json($data);
            }
            $data[] = array(
                'id' => $user->id,
                'balance' => $user->balance
            );
            return response()->json($data);
        } else {
            $data['error'] = 'Invalid Action';
            return response()->json($data);
        }
    }
}
?>