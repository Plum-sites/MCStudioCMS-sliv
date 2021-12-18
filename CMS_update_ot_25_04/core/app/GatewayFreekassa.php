<?php

namespace App;

use Auth;
use App\GeneralSetting;
use App\GatewayPaylogs;
use App\GatewayTransact;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ToolsController;

class GatewayFreekassa extends Model {

	protected $table = "gateway_freekassa";
	protected $guarded = [
		'id',
		'gateway_id'
	];
	protected $fillable = [
		'gateway_fullname',
        'gateway_description',
        'gateway_link',
        'gateway_store_id',
        'gateway_key1',
        'gateway_key2',
        'gateway_status'
	];

	public function __construct() {
		$this->general = GeneralSetting::first();
	}

	public function gateway() {
		return self::first();
	}

	protected function payment_respons($request = [], $type = 'error', $message = 'null') {
		if(@$type == 'error') {
			$resp = array(
	            "jsonrpc" => "2.0",
	            "error" => array(
	                "code" => -32000,
	                "message" => $message
	            ),
	            'id' => 1
	        );
		} else {
			$resp = array(
	            "jsonrpc" => "2.0",
	            "result" => array(
	                "message" => $message
	            ),
	            'id' => 1,
	        );
		}
		@file_put_contents($_SERVER['DOCUMENT_ROOT'].'/core/storage/logs/freekassa/request.json', json_encode(@$request, JSON_PRETTY_PRINT));
		@file_put_contents($_SERVER['DOCUMENT_ROOT'].'/core/storage/logs/freekassa/'.@$type.'.json', json_encode(@$resp, JSON_PRETTY_PRINT));
		return json_encode($resp);
	}

	public function payment_handler($request) {
		$order_id = @$request->MERCHANT_ORDER_ID;
		$order_sign = @$request->SIGN;
		$order_amount = @$request->AMOUNT;
		if(!@$order_id) {
			return $this->payment_respons(@$request, 'error', 'Parameter @account@ not passed');
		}
		if(!@$order_sign) {
			return $this->payment_respons(@$request, 'error', 'Parameter @signature@ not passed');
		}
		if(!@$order_amount) {
			return $this->payment_respons(@$request, 'error', 'Parameter @orderSum@ not passed');
		}
		$paysign = md5($this->gateway()->store_id.':'.$order_amount.':'.$this->gateway()->key_secret.':'.$order_id);
		if(strcmp(@$order_sign, @$paysign) !== 0) {
			return $this->payment_respons(@$request, 'error', 'Parameter @signature@ not valid ['.@$order_sign.'] - ['.@$paysign.']');
		}
		$payment = GatewayPaylogs::where('id', $order_id)->orderBy('id', 'DESC')->first();
		if(!@$payment->id) {
			return $this->payment_respons(@$request, 'error', 'Payment not found to system');
		}
		if(@$payment->status == 1) {
			return $this->payment_respons(@$request, 'error', 'Payment #'.@$payment->id.' already paid');
		}
		$user = User::where('id', $payment->user_id)->first();
		if(@$user->inviter_id && @$this->general->invite_percent) {
			$bonus_invt = @$payment->money / 100 * $this->general->invite_percent;
			$bonus_user = User::where('id', '=', @$user->inviter_id)->first();
			$bonus_user->balance_real = number_format($bonus_user->balance_real + $bonus_invt, 2, '.', '');
			$user->inviter_income = number_format($user->inviter_income + $bonus_invt, 2, '.', '');
			$bonus_user->save();
			GatewayTransact::create([
				'user_id' => $bonus_user->id,
				'gateway' => @$user->username,
				'amount' => $bonus_invt,
				'user_balance' => $bonus_user->balance_real,
				'charge' => null,
				'type' => '3',
				'trx' => ToolsController::hasherstring(str_random(12))
			]);
		}
		$bonus = 0;
		// if($payment->money >= 100) {
		// 	$bonus = number_format($payment->money / 100 * 5, 2, '.', '');
		// }
		$payment->status = 1;
		$payment->bonus = $bonus;
		// $payment->money = $payment->money;
		$payment->save();
		$user->balance_real += $payment->money;
		$user->save();
		GatewayTransact::create([
			'user_id' => $user->id,
			'gateway' => 'Free-Kassa',
			'amount' => $payment->money,
			'user_balance' => $user->balance_real,
			'charge' => null,
			'type' => '0',
			'trx' => ToolsController::hasherstring(str_random(12))
		]);
		return $this->payment_respons(@$request, 'success', 'Payment #'.@$payment->id.' successfully paid');
	}

	public function payment_redirect($request) {
		$user = Auth::user();
        $cash = (!@$request->amounter_val) ? '0' : $request->amounter_val;
        $build = array(
			'm' => $this->gateway()->store_id,
			'oa' => $cash,
			'em' => $user->email,
			'currency' => 'RUB',
			'lang' => 'ru'
		);
		$payment = GatewayPaylogs::create([
			'user_id' => $user->id,
			'money' => $build['oa'],
			'bonus' => '0',
			'system' => $this->gateway()->name,
			'status' => '0'
		]);
		$build['o'] = @$payment->id;
		$build['s'] = md5($this->gateway()->store_id.":".$cash.":".$this->gateway()->key_public.":RUB:".$build['o']);
		return $this->gateway()->link."/?".http_build_query($build);
	}

	public function payment_redirect_faster($data = array()) {
		$cash = (!@$data['order_price']) ? '0' : @$data['order_price'];
		$build = array(
			'oa' => @$cash,
			'm' => $this->gateway()->store_id,
			'o' => "TRX:".@$data['order_trx'],
			'em' => @$data['user_email'],
			's' => md5($this->gateway()->store_id.":".$cash.":".$this->gateway()->key_public.":"."TRX:".@$data['order_trx'])
		);

		GatewayPaylogs::create([
			'user_id' => @$data['user_id'],
			'money' => @$build['oa'],
			'bonus' => '0',
			'system' => @$this->gateway()->name,
			'status' => '0'
		]);
		return $this->gateway()->link."/?".http_build_query($build);
	}

}

?>