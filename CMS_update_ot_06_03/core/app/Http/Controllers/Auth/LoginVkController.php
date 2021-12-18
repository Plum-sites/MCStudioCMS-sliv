<?php

namespace App\Http\Controllers\Auth;

use DB;
use Auth;
use Image;

use App\User;
use App\Servers;
use App\GeneralSetting;
use App\GatewayTransact;
use App\Http\Lib\MinecraftQuery;

use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Token;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\MailerController;
use Illuminate\Support\Facades\Hash;

class LoginVkController extends Controller {

	public function __construct() {
        // session_start();
        $this->general = GeneralSetting::first();
    }

    public function hasherstring($string = 'default') {
        $hash = md5(md5($string.":".time()).":".md5($string.":".str_random(32)));
        $hash = substr($hash, 0, 16);
        return $hash;
    }

    public function loginVk() {
        $params = array(
            'scope' => 'email',
            'response_type' => 'code',
            'client_id' => $this->general->vk_client_id,
            'redirect_uri' => $this->general->vk_redirect_uri
        );
        $href = "https://oauth.vk.com/authorize?".@urldecode(@http_build_query(@$params));
        return $href;
    }

    public function loginVkAuth($request) {
        $result = false;
        $params = array(
            'code' => @$request->code,
            'client_id' => @$this->general->vk_client_id,
            'redirect_uri' => @$this->general->vk_redirect_uri,
            'client_secret' => @$this->general->vk_client_secret
        );
        $token = @file_get_contents('https://oauth.vk.com/access_token'.'?'.urldecode(http_build_query(@$params)));
        $token = @json_decode($token, true);
        if(@$token['access_token']) {
            $params = array(
                'v' => '5.115',
                'fields' => 'uid',
                'uids' => $token['user_id'],
                'access_token' => $token['access_token']
            );
            $user_info = @file_get_contents('https://api.vk.com/method/users.get'.'?'.@urldecode(@http_build_query(@$params)));
            $user_info = @json_decode($user_info, true);
            if(@$user_info['response'][0]['id']) {
                $user_info = @$user_info['response'][0];
                @file_put_contents('vk_response.json', json_encode(@$user_info, JSON_PRETTY_PRINT));
                $result = true;
            }
        }
        if(@$result) {
            $vk_id = @$user_info['id'];
            $vk_last_name = @$user_info['last_name'];
            $vk_first_name = @$user_info['first_name'];
            $user = User::where('vk_id', '=', @$vk_id)->first();
            if(@$user->id) {
                @Auth::login(@$user, true);
                @Auth::guard('admin')->login(@$user, true);
                $auth = @Auth::user();
                if(@$vk_last_name) {
                    $user->vk_last_name = @$vk_last_name;
                }
                if(@$vk_first_name) {
                    $user->vk_first_name = @$vk_first_name;
                }
                $user->logout = false;
                $user->save();
                $data = array(
                    'hide' => 1,
                    'type' => 'info',
                    'message' => 'Авторизация успешна, добро пожаловать '.@$user->username.'!'
                );
                return json_encode($data);
            } else {
                $user = User::where('id', '=', @Auth::user()->id)->orWhere('id', '=', Auth::guard('admin')->user()->id)->first();
                if(@$user->id) {
                    $user->vk_id = @$vk_id;
                    if(@$vk_last_name) {
                        $user->vk_last_name = @$vk_last_name;
                    }
                    if(@$vk_first_name) {
                        $user->vk_first_name = @$vk_first_name;
                    }
                    $user->save();
                    $data = array(
                        'hide' => 1,
                        'type' => 'info',
                        'message' => 'Аккаунт успешно привязан к странице VK'
                    );
                    return json_encode($data);
                } else {
                    $data = array(
                        'hide' => 0,
                        'type' => 'warning',
                        'message' => 'Ваш аккаунт VK не привязан ни к одному аккаунту на сайте'
                    );
                    return json_encode($data);
                }
            }
        }
    }

}
?>