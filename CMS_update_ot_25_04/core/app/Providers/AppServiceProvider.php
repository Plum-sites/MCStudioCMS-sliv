<?php

namespace App\Providers;

use Auth;
use App\User;
use App\UsersPrivileges;
use App\Servers;
use App\Privileges;
use App\GeneralSetting;
use App\GatewayQiwi;
use App\GatewayUnitpay;
use App\GatewayFreekassa;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        if(env('APP_HTTPS')) {
            \URL::forceScheme('https');
        }
        Schema::defaultStringLength(191);
        $user = User::where('id', '=', @Auth::user()->id)->first();
        $servers = Servers::where('status', '=', 1)->get();
        $general = GeneralSetting::first();
        $unitpay = new GatewayUnitpay();
        $freekassa = new GatewayFreekassa();
        $qiwihttps = new GatewayQiwi();
        $gateways = array(
            1 => $unitpay,
            2 => $freekassa,
            3 => $qiwihttps
        );
        // $servers_prefix = [];
        // $user_privileges = UsersPrivileges::where('user_id', '=', @$user->id)->get();
        // if(count(@$user_privileges) >= 1) {
        //     foreach($user_privileges as $key => $privilege) {
        //         $check_privileges = Privileges::where('id', '=', @$privilege->privilege_id)->first();
        //         if(@$check_privileges->id) {
        //             $servers_prefix = @$check_privileges->servers;
        //         }
        //     }
        // }
        view()->share(compact(
            'servers',
            'general',
            'gateways'
        ));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }
}
