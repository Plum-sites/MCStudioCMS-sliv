<?php

namespace App\Http\Controllers;

use App\Order;
use App\Service;
use App\ServicePrice;
use App\Transaction;
use App\User;
use App\GeneralSetting;
use Illuminate\Http\Request;
use Auth;
use DB;

class MailerController extends Controller {

    public function __construct() {
        session_start();
    }

    public static function mailSend($data) {
        $general = GeneralSetting::first();
        if(@$data['e_sender']) {
            $general->e_sender = $data['e_sender'];
        }
        $headers = "MIME-Version: 1.0\r\n";
        if(@$data['html']) {
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
        }
        $headers .= "From: ".$general->title." <".$general->e_sender.">\r\n";
        $headers .= "Cc: ".$general->e_sender."\r\n";
        $headers .= "Bcc: ".$general->e_sender."\r\n";
        mail($data['to'], $data['subject'], $data['message'], $headers);
        return true;
    }

}
?>