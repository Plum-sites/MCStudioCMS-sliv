<?php

namespace App\Http\Lib;

class TelegramMessage {

	private $token;

	public function __construct() {
		$this->token = "1368057496:AAHGjQAWoa5WC-6Lh6C2VpI37qy91Ta8p_I";
	}

	public function send($chat_id = '39146655', $chat_message = 'Не передано сообщение') {
	    $ch = curl_init();
	    curl_setopt_array(
	        $ch,
	        array(
	            CURLOPT_URL => 'https://api.telegram.org/bot'.$this->token.'/sendMessage',
	            CURLOPT_POST => TRUE,
	            CURLOPT_RETURNTRANSFER => TRUE,
	            CURLOPT_SSL_VERIFYPEER => false,
	            CURLOPT_SSL_VERIFYHOST => false,
	            CURLOPT_TIMEOUT => 10,
	            CURLOPT_POSTFIELDS => array(
	                'chat_id' => $chat_id,
	                'text' => $chat_message,
	            )
	        )
	    );
	    $result_json = curl_exec($ch);
	    $result_arrs = json_decode($result_json);
	    curl_close($ch);
	}

}

?>