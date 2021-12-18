<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ToolsController extends Controller {

	public function __construct(Request $request) {

	}
	 
	public static function uuidGenerator($string) {
	    $string = "OfflinePlayer:".$string;
	    $val = md5($string, true);
	    $byte = array_values(unpack('C16', $val));
	 
	    $tLo = ($byte[0] << 24) | ($byte[1] << 16) | ($byte[2] << 8) | $byte[3];
	    $tMi = ($byte[4] << 8) | $byte[5];
	    $tHi = ($byte[6] << 8) | $byte[7];
	    $csLo = $byte[9];
	    $csHi = $byte[8] & 0x3f | (1 << 7);
	 
	    if (pack('L', 0x6162797A) == pack('N', 0x6162797A)) {
	        $tLo = (($tLo & 0x000000ff) << 24) | (($tLo & 0x0000ff00) << 8) | (($tLo & 0x00ff0000) >> 8) | (($tLo & 0xff000000) >> 24);
	        $tMi = (($tMi & 0x00ff) << 8) | (($tMi & 0xff00) >> 8);
	        $tHi = (($tHi & 0x00ff) << 8) | (($tHi & 0xff00) >> 8);
	    }
	 
	    $tHi &= 0x0fff;
	    $tHi |= (3 << 12);
	   
	    $uuid = sprintf(
	        '%08x-%04x-%04x-%02x%02x-%02x%02x%02x%02x%02x%02x',
	        $tLo, $tMi, $tHi, $csHi, $csLo,
	        $byte[10], $byte[11], $byte[12], $byte[13], $byte[14], $byte[15]
	    );
	    return $uuid;
	}

	public static function getIp() {
		$data = array(
			'localip' => '127.0.0.1',
			'methods' => array(
				'HTTP_CLIENT_IP',
				'HTTP_X_FORWARDED_FOR',
				'HTTP_X_FORWARDED',
				'HTTP_X_CLUSTER_CLIENT_IP',
				'HTTP_FORWARDED_FOR',
				'HTTP_FORWARDED',
				'REMOTE_ADDR'
			)
		);
		foreach($data['methods'] as $key) {
	        if(array_key_exists($key, $_SERVER) === true) {
	            foreach(explode(',', $_SERVER[$key]) as $ip) {
	                $ip = trim($ip);
	                if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
	                    return $ip;
	                }
	            }
	        }
	    }
	    return $data['localip'];
	}

	public static function getSessions(Request $request) {
		$sessions = session()->all();
		// dd($sessions);
		return $sessions;
	}

	public static function sumbolsDate($string_date) {
		$unix_date = strtotime($string_date);
		$sumbol_date = date("d.m.Y в H:i", $unix_date);
		$sumbol_date = str_replace(date("d.m.Y"), "Сегодня", $sumbol_date);
		$sumbol_date = str_replace(date("d.m.Y", time()-86400), "Вчера", $sumbol_date);
		return $sumbol_date;
	}

	public static function sumbolsAgos($string_date) {
		$unix_date = strtotime($string_date);
	    $stf = 0;
	    $cur_time = time();
	    $diff = $cur_time - $unix_date;
	 
	    $seconds = array(
	    	'секунда',
	    	'секунды',
	    	'секунд'
	    );
	    $minutes = array(
	    	'минута',
	    	'минуты',
	    	'минут'
	    );
	    $hours = array(
	    	'час',
	    	'часа',
	    	'часов'
	    );
	    $days = array(
	    	'день',
	    	'дня',
	    	'дней'
	    );
	    $weeks = array(
	    	'неделя',
	    	'недели',
	    	'недель'
	    );
	    $months = array(
	    	'месяц',
	    	'месяца',
	    	'месяцев'
	    );
	    $years = array(
	    	'год',
	    	'года',
	    	'лет'
	    );
	    $decades = array(
	    	'десятилетие',
	    	'десятилетия',
	    	'десятилетий'
	    );
	    $phrase = array($seconds, $minutes, $hours, $days, $weeks, $months, $years, $decades);
	    $length = array(1, 60, 3600, 86400, 604800, 2630880, 31570560, 315705600);
	    for($i = sizeof($length) - 1; ($i >= 0) && (($no = $diff / $length[ $i ] ) <= 1); $i --) {
	        ;
	    }
	    if($i < 0) {
	        $i = 0;
	    }
	    $_time = $cur_time - ($diff % $length[ $i ]);
	    $no = floor( $no );
	    $value = sprintf( "%d %s ", $no, self::getPhraseWord($no, $phrase[$i]));
	    if(( $stf == 1) && ($i >= 1) && (($cur_time - $_time) > 0)) {
	        $value .= time_ago($_time);
	    }
	    return $value." назад";
	}

	public static function getPhrase($number, $titles) {
	    $cases = array(2, 0, 1, 1, 1, 2);
	    return $number." ".$titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
	}

	public static function getPhraseWord($number, $titles) {
	    $cases = array(2, 0, 1, 1, 1, 2);
	    return $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
	}

	// public static function sumbolsAgos($string_date) {
	// 	$unix_date = strtotime($string_date);
	//     $month_name = array(
	//         1 => 'января',
	//         2 => 'февраля',
	//         3 =>'марта',
	//         4 =>'апреля',
	//         5 =>'мая',
	//         6 =>'июня',
	//         7 =>'июля',
	//         8 =>'августа',
	//         9 =>'сентября',
	//         10 =>'октября',
	//         11 =>'ноября',
	//         12 =>'декабря'
	//     );
	//     // $month = $month_name[date('n', $unix_date)];
	//     $month = date('m', $unix_date);
	//     $day = date('d', $unix_date);
	//     $year = date('Y', $unix_date);
	//     $hour = date('H', $unix_date);
	//     $min = date('i', $unix_date);
	//     $date = $day. '.'.$month. '.'.$year. ' в '.$hour. ':'.$min;
	//     $dif = time() - $unix_date;
	//     if($dif < 59) {
	//         return $dif. " сек. назад";
	//     } elseif($dif / 60 > 1and $dif / 60 < 59) {
	//         return round($dif / 60). " мин. назад";
	//     } elseif($dif / 3600 > 1and $dif / 3600 < 23) {
	//         return round($dif / 3600). " час. назад";
	//     } elseif($dif / 3600 > 1and $dif / 3600 < 23) {
	//         return round($dif / 3600). " час. назад";
	//     } else {
	//     	$sumbol_date = str_replace(date("d.m.Y", time()-86400), "Вчера", $sumbol_date);
	//         return $date;
	//     }
	// }

	public static function hasherstring($string = 'default') {
        $hash = md5(md5($string.":".time()).":".md5($string.":".str_random(32)));
        $hash = substr($hash, 0, 16);
        return $hash;
    }

	public static function getBrowser(Request $request) {
		$u_agent = null;
		if($u_agent === null && @$request->server('HTTP_USER_AGENT')) {
			$u_agent = $request->server('HTTP_USER_AGENT');
		}
		$platform = null;
		$browser = null;
		$version = null;
		$empty = array(
			'platform' => $platform,
			'browser' => $browser,
			'version' => $version
		);
		if(!$u_agent) {
			return $empty;
		}
		if(preg_match('/\((.*?)\)/m', $u_agent, $parent_matches)) {
			preg_match_all('/(?P<platform>BB\d+;|Android|CrOS|Tizen|iPhone|iPad|iPod|Linux|(Open|Net|Free)BSD|Macintosh|Windows(\ Phone)?|Silk|linux-gnu|BlackBerry|PlayBook|X11|(New\ )?Nintendo\ (WiiU?|3?DS|Switch)|Xbox(\ One)?)
					(?:\ [^;]*)?
					(?:;|$)/imx', $parent_matches[1], $result);
			$priority = array(
				'Xbox One',
				'Xbox',
				'Windows Phone',
				'Tizen',
				'Android',
				'FreeBSD',
				'NetBSD',
				'OpenBSD',
				'CrOS',
				'X11'
			);
			$result['platform'] = array_unique($result['platform']);
			if(count($result['platform']) > 1) {
				if($keys = array_intersect($priority, $result['platform'])) {
					$platform = reset($keys);
				} else {
					$platform = $result['platform'][0];
				}
			} elseif(isset($result['platform'][0])) {
				$platform = $result['platform'][0];
			}
		}
		if($platform == 'linux-gnu' || $platform == 'X11') {
			$platform = 'Linux';
		} elseif($platform == 'CrOS') {
			$platform = 'Chrome OS';
		}
		preg_match_all(
			'%(?P<browser>Camino|Kindle(\ Fire)?|Firefox|Iceweasel|IceCat|Safari|MSIE|Trident|AppleWebKit|
			TizenBrowser|(?:Headless)?Chrome|YaBrowser|Vivaldi|IEMobile|Opera|OPR|Silk|Midori|Edge|Edg|CriOS|UCBrowser|Puffin|OculusBrowser|SamsungBrowser|
			Baiduspider|Googlebot|YandexBot|bingbot|Lynx|Version|Wget|curl|
			Valve\ Steam\ Tenfoot|
			NintendoBrowser|PLAYSTATION\ (\d|Vita)+)
			(?:\)?;?)
			(?:(?:[:/ ])(?P<version>[0-9A-Z.]+)|/(?:[A-Z]*))%ix',
			$u_agent, $result
		);
		if(!isset($result['browser'][0]) || !isset($result['version'][0])) {
			if(preg_match('%^(?!Mozilla)(?P<browser>[A-Z0-9\-]+)(/(?P<version>[0-9A-Z.]+))?%ix', $u_agent, $result)) {
				return array( 'platform' => $platform ?: null, 'browser' => $result['browser'], 'version' => isset($result['version']) ? $result['version'] ?: null : null );
			}
			return $empty;
		}
		if(preg_match('/rv:(?P<version>[0-9A-Z.]+)/i', $u_agent, $rv_result)) {
			$rv_result = $rv_result['version'];
		}
		$browser = $result['browser'][0];
		$version = $result['version'][0];
		$lowerBrowser = array_map('strtolower', $result['browser']);
		$find = function($search, &$key = null, &$value = null) use ($lowerBrowser) {
			$search = (array)$search;
			foreach($search as $val) {
				$xkey = array_search(strtolower($val), $lowerBrowser);
				if($xkey !== false) {
					$value = $val;
					$key = $xkey;
					return true;
				}
			}
			return false;
		};
		$findT = function(array $search, &$key = null, &$value = null) use ($find) {
			$value2 = null;
			if($find(array_keys($search), $key, $value2)) {
				$value = $search[$value2];
				return true;
			}
			return false;
		};

		$key = 0;
		$val = '';
		if($findT(array('OPR' => 'Opera', 'UCBrowser' => 'UC Browser', 'YaBrowser' => 'Yandex', 'Iceweasel' => 'Firefox', 'Icecat' => 'Firefox', 'CriOS' => 'Chrome', 'Edg' => 'Edge'), $key, $browser)) {
			$version = $result['version'][$key];
		}elseif($find('Playstation Vita', $key, $platform)) {
			$platform = 'PlayStation Vita';
			$browser  = 'Browser';
		} elseif( $find(array( 'Kindle Fire', 'Silk' ), $key, $val) ) {
			$browser  = $val == 'Silk' ? 'Silk' : 'Kindle';
			$platform = 'Kindle Fire';
			if( !($version = $result['version'][$key]) || !is_numeric($version[0]) ) {
				$version = $result['version'][array_search('Version', $result['browser'])];
			}
		} elseif( $find('NintendoBrowser', $key) || $platform == 'Nintendo 3DS' ) {
			$browser = 'NintendoBrowser';
			$version = $result['version'][$key];
		} elseif( $find('Kindle', $key, $platform) ) {
			$browser = $result['browser'][$key];
			$version = $result['version'][$key];
		} elseif( $find('Opera', $key, $browser) ) {
			$find('Version', $key);
			$version = $result['version'][$key];
		} elseif( $find('Puffin', $key, $browser) ) {
			$version = $result['version'][$key];
			if( strlen($version) > 3 ) {
				$part = substr($version, -2);
				if( ctype_upper($part) ) {
					$version = substr($version, 0, -2);

					$flags = array( 'IP' => 'iPhone', 'IT' => 'iPad', 'AP' => 'Android', 'AT' => 'Android', 'WP' => 'Windows Phone', 'WT' => 'Windows' );
					if( isset($flags[$part]) ) {
						$platform = $flags[$part];
					}
				}
			}
		} elseif( $find(array( 'IEMobile', 'Edge', 'Midori', 'Vivaldi', 'OculusBrowser', 'SamsungBrowser', 'Valve Steam Tenfoot', 'Chrome', 'HeadlessChrome' ), $key, $browser) ) {
			$version = $result['version'][$key];
		} elseif( $rv_result && $find('Trident') ) {
			$browser = 'MSIE';
			$version = $rv_result;
		} elseif( $browser == 'AppleWebKit' ) {
			if( $platform == 'Android' ) {
				$browser = 'Android Browser';
			} elseif( strpos($platform, 'BB') === 0 ) {
				$browser  = 'BlackBerry Browser';
				$platform = 'BlackBerry';
			} elseif( $platform == 'BlackBerry' || $platform == 'PlayBook' ) {
				$browser = 'BlackBerry Browser';
			} else {
				$find('Safari', $key, $browser) || $find('TizenBrowser', $key, $browser);
			}

			$find('Version', $key);
			$version = $result['version'][$key];
		} elseif( $pKey = preg_grep('/playstation \d/i', $result['browser']) ) {
			$pKey = reset($pKey);

			$platform = 'PlayStation ' . preg_replace('/\D/', '', $pKey);
			$browser  = 'NetFront';
		}

		return array( 'platform' => $platform ?: null, 'browser' => $browser ?: null, 'version' => $version ?: null );
	}
}

?>