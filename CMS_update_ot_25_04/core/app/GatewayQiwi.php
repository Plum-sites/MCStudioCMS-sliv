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

class GatewayQiwi extends Model {

	protected $table = "gateway_qiwi";
	protected $guarded = [
		'id',
		'gateway_id'
	];
	protected $qiwi_api = '';

	public function __construct() {
		$this->general = GeneralSetting::first();
		require($_SERVER['DOCUMENT_ROOT']."/core/vendor/p2pqiwi/autoload.php");
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
		$entity_body = file_get_contents('php://input');
		$array_body = json_decode($entity_body, 1);
		$amount_currency = $array_body['bill']['amount']['currency'];
		$amount_value = $array_body['bill']['amount']['value'];
		$billId = $array_body['bill']['billId'];
		$siteId = $array_body['bill']['siteId'];
		$status_value = $array_body['bill']['status']['value'];
		$invoice = $amount_currency.'|' .$amount_value.'|'.$billId .'|'.$siteId .'|'.$status_value;
		if(@$_SERVER['HTTP_X_API_SIGNATURE_SHA256'] == hash_hmac('sha256', $invoice, $this->gateway()->key_secret)) {
			$user = User::where('id', $array_body['bill']['customer']['account'])->first();
			$payment = GatewayPaylogs::where([
				['id', '=', $array_body['bill']['customFields']['paylogsId']],
				['user_id', '=', $user->id]
			])->orderBy('id', 'DESC')->first();
			if(!@$payment->id) {
				return $this->payment_respons('error', 'Payment not found to system');
			}
			if(@$payment->status == 1) {
				return $this->payment_respons('error', 'Payment #'.@$payment->id.' already paid');
			}

			if(@$user->inviter_id && @$this->general->invite_percent) {
				$bonus_invt = @$payment->money / 100 * (!@$this->general->invite_percent) ? 0 : $this->general->invite_percent;
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
			
			$money = number_format($payment->money, 2, '.', '');
			$money_bonus = number_format($money + $bonus, 2, '.', '');
			$payment->status = 1;
			$payment->bonus = $bonus;
			$payment->money = $money;
			$payment->save();
			$user->balance_real = number_format($user->balance_real + $money_bonus, 2, '.', '');
			$user->save();
			GatewayTransact::create([
				'user_id' => $user->id,
				'gateway' => 'QiwiPay',
				'amount' => $money,
				'user_balance' => $user->balance_real,
				'charge' => null,
				'type' => '0',
				'trx' => ToolsController::hasherstring(str_random(12))
			]);
			return $this->payment_respons('success', 'Payment #'.@$payment->id.' successfully paid');
		}
	}

	public function payment_redirect($request) {
		$this->qiwi_api = new \Qiwi\Api\BillPayments(self::gateway()->key_secret);
		$user = Auth::user();
        $cash = (!@$request->amounter_val) ? '0' : number_format($request->amounter_val, 2, '.', '');
        $paylogs = new GatewayPaylogs();
        $paylogs->user_id = @$user->id;
        $paylogs->money = $cash;
        $paylogs->bonus = '0';
        $paylogs->system = 'QiwiPay';
        $paylogs->status = '0';
        $paylogs->save();
        $fields = array(
            'amount'                => @$cash,
            'currency' 				=> 'RUB',
            'publicKey'             => self::gateway()->key_public,
            'comment'               => self::gateway()->description." ".@$user->username,
            'expirationDateTime'    => date('c', time() + 60*2),
            'successUrl'            => route('dashboard'),
            'account' 				=> @$user->id,
            'email' 				=> @$user->email,

        	'customFields' 			=> array(
        		'paylogsId'			=> $paylogs->id,
            	'themeCode' 		=> self::gateway()->theme_code
            )
        );
        $response = $this->qiwi_api->createPaymentForm($fields);
        // @file_put_contents($_SERVER['DOCUMENT_ROOT'].'/qiwip2p.json', @$response);
        if(@$response) {
	        return $response;
        } else {
        	redirect()->away('/');
        }
	}

	public function payment_redirect_faster($data = array()) {
		// BillPayments
	}

}

?>