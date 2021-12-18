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

	protected function payment_respons($type = 'error', $message = 'null') {
		if(@$type == 'error') {
			return json_encode(array(
	            "jsonrpc" => "2.0",
	            "error" => array(
	                "code" => -32000,
	                "message" => $message
	            ),
	            'id' => 1
	        ));
		}
		return json_encode(array(
            "jsonrpc" => "2.0",
            "result" => array(
                "message" => $message
            ),
            'id' => 1,
        ));
	}

	public function payment_handler($request) {
		$requser = @$request->MERCHANT_ORDER_ID;
		$reqsign = @$request->SIGN;
		$reqsumm = @$request->AMOUNT;
		$reqserv = ToolsController::getIp();
		if(!@$requser) {
			return $this->payment_respons('error', 'Parameter @account@ not passed');
		}
		if(!@$reqsign) {
			return $this->payment_respons('error', 'Parameter @signature@ not passed');
		}
		if(!@$reqsumm) {
			return $this->payment_respons('error', 'Parameter @orderSum@ not passed');
		}
		$paysign = md5($this->gateway()->store_id.':'.$reqsumm.':'.$this->gateway()->key_secret.':'.$requser);
		if(strcmp(@$reqsign, @$paysign) !== 0) {
			return $this->payment_respons('error', 'Parameter @signature@ not valid ['.@$reqsign.'] - ['.@$paysign.']');
		}

		$trx = explode(":", @$requser);
		if(@$trx[0] == "TRX") {
			$order = Order::where('trx', '=', @$trx[1])->first();
			if(@$order->id) {
				if(!@$order->fast_payed) {
					$user = @$order->user;
					$payment = GatewayPaylogs::where('user_id', '=', @$user->id)->first();

					$payment->status = 1;
					$payment->bonus = 0;
					$payment->money = number_format(@$order->price, 2, '.', '');
					$payment->save();
					
					$order->fast_payed = 1;
					$order->fast_links = "";
					$order->save();

					GatewayTransact::create([
						'user_id' => @$user->id,
						'gateway' => 'UnitPay',
						'amount' => number_format(@$order->price, 2, '.', ''),
						'user_balance' => number_format(@$user->balance_real, 2, '.', ''),
						'charge' => null,
						'type' => '5',
						'trx' => @$order->trx
					]);
					return $this->payment_respons('success', 'Order #'.@$order->id.' successfully paid');
				} else {
					return $this->payment_respons('error', 'Order #'.@$order->id.' already paid');
				}
			} else {
				return $this->payment_respons('error', 'Order '.@$trx[1].' not found');
			}
		} else {
			$payment = GatewayPaylogs::where('id', $requser)->orderBy('id', 'DESC')->first();
			if(!@$payment->id) {
				return $this->payment_respons('error', 'Payment not found to system');
			}
			if(@(int)$payment->money != @(int)$reqsumm) {
				return $this->payment_respons('error', 'Payment amounts do not match');
			}
			if(@$payment->status == 1) {
				return $this->payment_respons('error', 'Payment #'.@$payment->id.' already paid');
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
			return $this->payment_respons('success', 'Payment #'.@$payment->id.' successfully paid');
		}
	}

	public function payment_redirect($request) {
		$user = Auth::user();
        $cash = (!@$request->amounter_val) ? '0' : $request->amounter_val;
        $build = array(
			'm' => $this->gateway()->store_id,
			'oa' => $cash,
			'em' => $user->email
		);
		$payment = GatewayPaylogs::create([
			'user_id' => $user->id,
			'money' => $build['oa'],
			'bonus' => '0',
			'system' => $this->gateway()->name,
			'status' => '0'
		]);
		$build['o'] = @$payment->id;
		$build['s'] = md5($this->gateway()->store_id.":".$cash.":".$this->gateway()->key_public.":".$build['o']);
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