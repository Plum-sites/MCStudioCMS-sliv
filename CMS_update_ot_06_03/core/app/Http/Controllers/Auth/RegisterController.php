<?php

namespace App\Http\Controllers\Auth;

use Cookie;
use Session;
use App\GeneralSetting;
use App\User;
use App\UserAuth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\MailerController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request) {
        session_start();
        $this->request = $request;
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateRegister(Request $request) {
        return $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'username' => 'required|string|alpha_dash|max:16|unique:users|regex:/(^([A-Za-z\-_][A-Za-z0-9\-_]+)(\d+)?$)/u'
        ],
        [
            'email.unique' => 'Данный e-mail уже используется в системе',
            'email.required' => 'Не введён e-mail пользователя',
            'password.required' => 'Не введён пароль пользователя',
            'password.min' => 'Минимальная длина пароля 6 символов',
            'password.confirmed' => 'Введённые пароли не совпадают',
            'username.required' => 'Не введён логин пользователя',
            'username.max' => 'Максимальная длина логина 16 символов',
            'username.regex' => 'Логин должен состоять из латиницы и цифр',
            'username.unique' => 'Данный логин уже используется в системе'
        ]);
    }

    /**
     * Validate the enter captcha request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateCaptcha($request) {
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
            ///#!#\\\
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Вы ввели не верный код с картинки'
            );
            return response()->json($data);
        }
    }

    protected function register(Request $request) {
        $inviter_id = !(@$_SESSION['inviter_id']) ? 0 : @$_SESSION['inviter_id'];
        $captcha = $this->validateCaptcha($request);
        if($captcha) {
            return $captcha;
        }
        $this->validateRegister($request);

        $general = GeneralSetting::first();
        if($general->email_verification == 1 && !@$request->codes_verify) {
            $user = new User();
            $user->username = $request->username;
            $codes_verify = strtoupper(str_random(32));
            session()->put('codes_verify', $codes_verify);
            $email_verify = 0;
            $data_text = "
                Подтверждение регистрации аккаунта на нашем сайте.
                <table class='table-color'>
                    <tr style='text-align:left;'>
                        <td style='max-width:135px;'>Ваш проверочный код</td>
                        <td>
                            <u>".$codes_verify."</u>
                        </td>
                    </tr>
                </table>
            ";
            @MailerController::mailSend(array(
                'to' => $request->email,
                'subject' => 'Подтверждение регистрации',
                'message' => view('mailer.dashboard', compact('general', 'user', 'data_text')),
                'html' => true
            ));
            $data = array(
                'type' => 'warning',
                'message' => 'На E-Mail отправлен код подтверждения',
                'codes_verify' => true
            );
            return response()->json($data);
        } elseif($general->email_verification == 1 && @$request->codes_verify == @session()->get('codes_verify')) {
            $codes_verify = @$request->codes_verify;
            $email_verify = 1;
        } else {
            $email_verify = 0;
        }
        $api_key = str_random(30);
        $user = User::create([
            // 'name' => strtolower($request->username),
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'uuid' => ToolsController::uuidGenerator($request->username),
            'ip_address' => ToolsController::getip(),
            'verification_time' => Carbon::now(),
            'verification_code' => @$codes_verify,
            'email_verify' => $email_verify,
            'api_key' => $api_key,
            'auth_at' => time(),
            'inviter_id' => @$inviter_id
        ]);
        $data_pc = ToolsController::getBrowser(@$request);
        UserAuth::create([
            'user_id' => $user->id,
            'user_ip' => $user->ip_address,
            'user_os' => (!@$data_pc['platform']) ? 'Unknown' : @$data_pc['platform'],
            'user_browser' => (!@$data_pc['browser']) ? 'Unknown' : @$data_pc['browser'],
            'type' => '1'
        ]);
        $data_text = "
            Вы успешно прошли регистрацию на нашем сайте, поздравляем!
            <table class='table-color'>
                <tr>
                    <th>ID</th>
                    <th>Логин</th>
                    <th>Пароль</th>
                    <th>Статус</th>
                </tr>
                <tr>
                    <td>#".@$user->id."</th>
                    <td>".@$request->username."</td>
                    <td>".@$request->password."</td>
                    <td>Подтверждён</td>
                </tr>
            </table>
        ";
        @MailerController::mailSend(array(
            'to' => $request->email,
            'subject' => 'Завершение регистрации',
            'message' => view('mailer.dashboard', compact('general', 'user', 'data_text')),
            'html' => true
        ));
        $this->guard()->login($user);
    }

}
