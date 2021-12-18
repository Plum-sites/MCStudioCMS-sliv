<?php

namespace App\Http\Controllers\Auth;

// use Cookie;
// use Session;
// use App\Http\Requests;
use App\User;
use App\UserAuth;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ToolsController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Cookie;

class LoginController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request) {
        $this->validate(@$request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ],
        [
            'username.required' => 'Не введён логин пользователя',
            'password.required' => 'Не введён пароль пользователя',
        ]);
    }

    /**
     * Validate the enter captcha request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateCaptcha(Request $request) {
        $captcha_get = @session()->get('captcha');
        $captcha_req = @$request->captcha;
        if(!@$captcha_req) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите код с картинки в поле ввода'
            );
            return response()->json($data);
        }
        if(strtolower(@$captcha_req) == strtolower(@$captcha_get)) {

        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Вы ввели не верный код с картинки'
            );
            return response()->json($data);
        }
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request) {
        $captcha = @$this->validateCaptcha(@$request);
        if(@$captcha) {
            return @$captcha;
        }
        $this->validateLogin(@$request);
        $remember_me = @$request->has('remember') ? true : false;
        $login = @$request->input('username');
        $login_type = (!filter_var($login, FILTER_VALIDATE_EMAIL)) ? 'username' : 'email';
        $auth_check = @Auth::attempt([
            $login_type => @$login,
            'password' => @$request->input('password')
        ], @$remember_me);
        $data_ip = ToolsController::getip();
        $data_pc = ToolsController::getBrowser(@$request);
        $user_select = User::where('username', @$request->input('username'))->orWhere('email', @$request->input('username'))->first();
        if(@$auth_check) {
            $auth = @Auth::user();
            @Auth::login(@$auth, true);
            $user = User::where('id', @$auth->id)->first();
            // return @$user->status;
            if(@$user->status == '1') {
                $user->auth_at = time();
                $user->ip_address = $data_ip;
                UserAuth::create([
                    'user_id' => $user->id,
                    'user_ip' => $user->ip_address,
                    'user_os' => (!@$data_pc['platform']) ? 'Unknown' : @$data_pc['platform'],
                    'user_browser' => (!@$data_pc['browser']) ? 'Unknown' : @$data_pc['browser'].' '.@$data_pc['version'],
                    'type' => '1'
                ]);
                $user->logout = false;
                if(!@$user->uuid) {
                    $user->uuid = ToolsController::uuidGenerator(@$user->username);
                }
                $user->save();
                Auth::guard('admin')->attempt([
                    'access' => 1,
                    'username' => @$request->input('username'),
                    'password' => @$request->input('password')
                ]);
                $data = array(
                    'type' => 'info',
                    'message' => 'Авторизация успешна, добро пожаловать '.@$user->username.'!'
                );
                return response()->json($data);
            } else {
                $data = array(
                    'type' => 'danger',
                    'message' => 'Этот аккаунт заблокирован!'
                );
                return response()->json($data);
            }
        } else {
            if(@$user_select->id) {
                UserAuth::create([
                    'user_id' => $user_select->id,
                    'user_ip' => $data_ip,
                    'user_os' => (!@$data_pc['platform']) ? 'Unknown' : @$data_pc['platform'],
                    'user_browser' => (!@$data_pc['browser']) ? 'Unknown' : @$data_pc['browser'],
                    'type' => '0'
                ]);
            }
            $data = array(
                'type' => 'warning',
                'message' => 'Не правильный логин и/или пароль'
            );
            return response()->json($data);
        }
    }

}
