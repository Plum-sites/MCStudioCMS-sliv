<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

use App\GeneralSetting;

class Offline {

	/**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $user = Auth::user();
        $admin = Auth::guard('admin')->user();
        $general = GeneralSetting::first();
        $request_url = strtolower(@$_SERVER['REQUEST_URI']);
        $request_url = explode("/", @$request_url);
        // return @Auth::guard('admin')->user()->username;
        // dd($request_url);
        if(@$general->site_offline == 1) {
            $general->description = $general->description." (Offline)";
            $access1 = array(
                'admin'
            );
            $access2 = array(
                'monitoring',
                'privileges',
                'mcrate',
                'topcraft',
                'minecraftrating'
            );
            if(!in_array(@$request_url[1], @$access1)) {
                if(!in_array(@$request_url[1], $access2) && !in_array(@$request_url[2], @$access2)) {
                    if(@$admin->access != 1) {
                        return response()->view('frontend.offline', compact('general', 'request_url', 'user', 'admin'));
                    }
                }
            }
            // if(@$user->access != 1 && @$request_url[1] != 'admin') {
            //     return response()->view('frontend.offline', compact('general', 'request_url'));
            // }
        }
        return $next($request);
    }
}

?>