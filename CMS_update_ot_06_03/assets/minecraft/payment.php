<?php

#
#	Файл-обработчик приёма платежа FreeKassa
#	Writed MCSTUDIO
#

error_reporting(-1);
ini_set('display_errors', 1);

logData('-----------------------------<br/>Incoming request');
logData(var_export($_REQUEST,true));

	define ( 'DATALIFEENGINE', true );
	define ( 'ROOT_DIR', dirname ( __DIR__ ) );
	define ( 'ENGINE_DIR', ROOT_DIR . '/engine' );

	require_once ENGINE_DIR . '/classes/mysql.php';
	require_once ENGINE_DIR . '/data/dbconfig.php';
	require_once ENGINE_DIR . '/data/config_lk.php';

	$cid = getConfig('freekassa_id');
	$csec2 = getConfig('freekassa_secret2');
	
	logData('merch id: '.$cid);
	logData('secret 2: '.$csec2);
	
	//Check incoming IP
	function getIP() {
		if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
		return $_SERVER['REMOTE_ADDR'];
	}
	
	logData('IP: '.getIP());
	
	if (!in_array(getIP(), array('136.243.38.147', '136.243.38.149', '136.243.38.150', '136.243.38.151', '136.243.38.189', '88.198.88.98', '162.158.91.105'))) {
		logData('IP denied');
		die("Hacking attempt!");
	}
	
	
	// Check signature
	$signature = md5($_REQUEST['MERCHANT_ID'].':'.$_REQUEST['AMOUNT'].':'.$csec2.':'.$_REQUEST['MERCHANT_ORDER_ID']);
	
	if ($signature !== $_REQUEST['SIGN']) {
		die('Wrong signature!');
    }

	logData('sign: '.$signature);	
		
	logData('UPDATE `'.PREFIX.'_users` SET `money` = `money` + '.$_REQUEST['AMOUNT'].' WHERE `name` = "'.$_REQUEST['MERCHANT_ORDER_ID'].'"');
	
	$db->query('UPDATE `'.PREFIX.'_users` SET `money` = `money` + '.$_REQUEST['AMOUNT'].' WHERE `name` = "'.$_REQUEST['MERCHANT_ORDER_ID'].'"');
	moneyLog('Пополнение баланса игрока '.($_REQUEST['MERCHANT_ORDER_ID']).' на '.$_REQUEST['AMOUNT'].' руб.',2,$_REQUEST['AMOUNT'],$_REQUEST['MERCHANT_ORDER_ID'],null);
	logData('request finiched');
	die('YES');
	
function logData($data){
	file_put_contents('payment.log.fr34rhrhw4hrfh45ff.html',$data.'<br/><br/>',FILE_APPEND);
}

function moneyLog($message,$type,$amount,$from = '',$to = ''){
	global $db;
	$db->query('INSERT INTO `'.PREFIX.'_lk_logs` (`message`,`type`,`from`,`to`,`count`) VALUES ("'.$db->safesql($message).'",'.((int)$type).',"'.$db->safesql($from).'","'.$db->safesql($to).'",'.((int)$amount).')');
}

function getConfig($var){
	global $config_lk;
	return $config_lk[$var];
}