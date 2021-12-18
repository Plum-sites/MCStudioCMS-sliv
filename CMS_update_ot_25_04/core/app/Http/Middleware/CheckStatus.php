<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            $user = User::where('id', '=', Auth()->user()->id)->first();
            if(@$user->status == '1') {
                return $next($request);
            } else {
                $user->logout = true;
                $user->save();
                return redirect()->route('blocked');
            }
        }
    }
}
