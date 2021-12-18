<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\UsersNotify;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotifyController extends Controller {


	public static function modal() {
		$notify = UsersNotify::where([
			['user_id', '=', @Auth::user()->id],
			['status', '=', 1]
		])->latest()->first();
		if(@$notify->id) {
			$notify->status = 0;
			$notify->save();
			return view('notify.modal-show', compact('notify'));
		}
	}

	public static function count() {
		$notify = UsersNotify::where([
			['user_id', '=', @Auth::user()->id],
			['status', '=', 1]
		])->count('id');
		if(@$notify >= 1) {
			return $notify;
		}
	}

	public static function sender() {
		return @UsersNotify::sender();
	}

}

?>