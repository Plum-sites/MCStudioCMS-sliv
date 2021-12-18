<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Carbon;

class LoginController extends Controller {

    public function __construct() {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm() {
        return view('admin.login');
    }

    public function username() {
        return 'username';
    }

    public function login(Request $request) {

        $this->validate($request, [
            'username'   => 'required',
            'password' => 'required'
        ]);
        $check = Auth::guard('admin')->attempt([
            'access' => 1,
            'username' => $request->username,
            'password' => $request->password
        ]);
        if(@$check) {
            $check2 = Auth::attempt([
                'username' => $request->username,
                'password' => $request->password
            ]);
            return redirect()->route('admin.dashboard');
        } else {
           session()->flash('error', 'Неверные данные для входа');
           return back();
        }
    }
    
    public function logout(Request $request) {
        Auth::logout();
        Auth::guard('admin')->logout();
        session()->flush();
        return redirect('/admin');
    }
}
