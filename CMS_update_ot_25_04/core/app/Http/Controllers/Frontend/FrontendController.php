<?php

namespace App\Http\Controllers\Frontend;

use DB;
use Mail;
use Auth;
use Image;
use Session;

use App\User;
use App\UserAuth;
use App\UsersNotify;
use App\UsersPrivileges;
use App\UsersPrefixes;
use App\UsersRatings;
use App\Servers;
use App\ServersDB;
use App\Privileges;
use App\Kits;
use App\PasswordReset;
use App\Promos;

use App\Items;
use App\Category;
use App\GatewayQiwi;
use App\GatewayUnitpay;
use App\GatewayFreekassa;
use App\GatewayTransact;
use App\GatewayPaylogs;
use App\GeneralSetting;
use App\RatingsSetting;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\MailerController;
use App\Http\Controllers\Auth\LoginVkController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class FrontendController extends Controller {

    protected $user;
    #######################################################################################################################################
    public function __construct() {
        session_start();
        Servers::servers();
        $this->general = GeneralSetting::first();
        $this->ratings = RatingsSetting::count();
        $this->vk_controller = new LoginVkController();
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if(@$this->user->id) {
                $this->user = User::where('id', '=', $this->user->id)->first();
                $this->lastsauth($this->user);
                if(!@$this->user->uuid) {
                    $this->user->uuid = ToolsController::uuidGenerator($this->user->username);
                    $this->user->save();
                }
            }
            return $next($request);
        });
    }
    public function hasherstring($string = 'default') {
        $hash = md5(md5($string.":".time()).":".md5($string.":".str_random(32)));
        $hash = substr($hash, 0, 16);
        return $hash;
    }
    public function lastsauth($user) {
        if(@$user->id) {
            if(@$user->auth_at+300 <= time()) {
                $user->auth_at = time();
                $user->save();
            }
        }
    }
    public function redirectVkAuth() {
        $vk_response = @$this->vk_controller->loginVk();
        return redirect()->away($vk_response);
    }
    public function redirectVkBind(Request $request) {
        $vk_response = @$this->vk_controller->loginVkBind(@$request);
        return self::dashboard();
    }
    public function balanceGet(Request $request) {
        if(@$this->user->id) {
            $data['balance_real'] = (!@$this->user->balance_real) ? 0 : @$this->user->balance_real;
            $balance_list_server_id = @$request->balance_list_server_id;
            if(@$balance_list_server_id) {
                $server = Servers::where('id', '=', @$balance_list_server_id)->first();
                if(@$server->id) {
                    if(@Schema::connection('server_'.@$server->id)->hasTable(@$server->mysql_table_coin)) {
                        $balance = @DB::connection('server_'.@$server->id)->table(@$server->mysql_table_coin)->where('username', '=', @$this->user->username)->first();
                        $data['balance_game'] = (!@$balance->balance) ? '0' : @$balance->balance;
                    }  else {
                        $data['balance_game'] = '0';
                    }
                }
            }
            return response()->json($data);
        }
    }
    public function balancePayment(Request $request) {
        $sum_pays_rubs = $request->sum_pays_rubs;
        if(@$sum_pays_rubs >= 1) {
            $request->amounter_val = @$sum_pays_rubs;
            if(@$this->general->gateway_use) {
                $unitpay = new GatewayUnitpay();
                $freekassa = new GatewayFreekassa();
                $qiwihttps = new GatewayQiwi();
                $gateways = array(
                    1 => $unitpay,
                    2 => $freekassa,
                    3 => $qiwihttps
                );
                $gateway = $gateways[@$this->general->gateway_use];
                $gateway_row = @$gateway->gateway();
                $data = array(
                    'type' => 'info',
                    'message' => '?????????????????????????????? ???? ????????????...',
                    'link' => @$gateway->payment_redirect($request)
                );
                return response()->json($data);
            } else {
                $data = array(
                    'type' => 'warning',
                    'message' => '?? ???????????? ???????????? ????????????????????'
                );
                return response()->json($data);
            }
        } else {
            $data = array(
                'type' => 'warning',
                'message' => '???? ???? ?????????? ?????????? ????????????????????'
            );
            return response()->json($data);
        }
    }
    public function balanceExchange(Request $request) {
        $sum_pays_coin = $request->sum_pays_coin;
        $balance_server_id = $request->balance_server_id;
        if(@$this->user->id) {
            if(@$sum_pays_coin >= 1) {
                if(@$this->user->balance_real >= @$sum_pays_coin) {
                    $server = Servers::where('id', '=', @$balance_server_id)->first();
                    if(@$server->id) {
                        if(@Schema::connection('server_'.@$server->id)->hasTable(@$server->mysql_table_coin)) {
                            $balance_mult = @$sum_pays_coin * @$this->general->exch_rubs_to_coin;
                            $balance_plus = @DB::connection('server_'.@$server->id)->table(@$server->mysql_table_coin)->where('username', '=', @$this->user->username)->first();
                            if(!@$balance_plus->username) {
                                $balance_plus = @DB::connection('server_'.@$server->id)->table(@$server->mysql_table_coin)->insertGetId([
                                    'username' => @$this->user->username,
                                    'balance' => '0.0'
                                ]);
                            }
                            $balance_plus = @DB::connection('server_'.@$server->id)->table(@$server->mysql_table_coin)->where('username', '=', @$this->user->username)->update([
                                'balance' => @$balance_plus->balance + @$balance_mult
                            ]);
                            if(@$balance_plus) {
                                $balance_minus = @$this->user->balance_real - @$sum_pays_coin;
                                $this->user->balance_real = $balance_minus;
                                $this->user->save();
                                $data = array(
                                    'type' => 'info',
                                    'message' => '???? ???????????????? '.@$sum_pays_coin.' '.@$this->general->currency_symbol.' ???? '.$balance_mult.' '.@$this->general->game_symbol
                                );
                                return response()->json($data);
                            } else {
                                $data = array(
                                    'type' => 'warning',
                                    'message' => '???????????? ???????????????? ?? ???????????????????? ??????????????'
                                );
                                return response()->json($data);
                            }
                        } else {
                            $data = array(
                                'type' => 'warning',
                                'message' => '?????? ?????????????????????? ?? ???????????????????? ??????????????'
                            );
                            return response()->json($data);
                        }
                    } else {
                        $data = array(
                            'type' => 'warning',
                            'message' => '?????????????????? ???????????? ???? ???????????? ?? ???????? ????????????'
                        );
                        return response()->json($data);
                    }
                } else {
                    $data = array(
                        'type' => 'warning',
                        'message' => '?? ?????? ???????????????????????? ?????????????? ?????? ????????????'
                    );
                    return response()->json($data);
                }
            } else {
                $data = array(
                    'type' => 'warning',
                    'message' => '?????????? ???? ?????????? ???????? ???????????? ????????'
                );
                return response()->json($data);
            }
        } else {
            $data = array(
                'type' => 'warning',
                'message' => '???????????? ????????????????, ???????????????? ????????????????'
            );
            return response()->json($data);
        }
    }
    #######################################################################################################################################
    public function dashboard(Request $request) {
        $vk_response = [];
        
        $general = $this->general; // ?????????????? ?? php 7.3 ?????? ?????????? ???? ???????????????? ???????????????? ???????????????????? ?? view

        if(@$request->code && request()->path() == 'login/vk/auth') {
            $vk_response = @$this->vk_controller->loginVkAuth(@$request);
            $vk_response = json_decode(@$vk_response);
        }
        if(@$request->code && request()->path() == 'login/vk/bind') {
            $vk_response = @$this->vk_controller->loginVkBind(@$request);
            $vk_response = json_decode(@$vk_response);
        }
        $news_json = @file_get_contents($_SERVER['DOCUMENT_ROOT']."/news.json");
        $news_json = json_decode(@$news_json, true);
        
        if(isset($news_json['error'])) {
            $news_list = $news_json;

            return view('frontend.dashboard', compact('news_list', 'general', 'request', 'vk_response'));
        }
        else {
            $news_list = $news_json['response']['items'];

            return view('frontend.dashboard', compact('news_list', 'general', 'request', 'vk_response'));
        }
    }
    #######################################################################################################################################
    public function rules() {
        $general = $this->general;

        return view('frontend.pages.rules', compact('general'));
    }
    #######################################################################################################################################
    public function start() {
        $general = $this->general;

        return view('frontend.pages.start', compact('general'));
    }
    #######################################################################################################################################
    public function donate() {
        $general = $this->general;

        return view('frontend.pages.donate', compact('general'));
    }
    #######################################################################################################################################
    public function profile() {
        $general = $this->general;

        return view('frontend.pages.profile', compact('general'));
    }
    #######################################################################################################################################
    // public function ratingsGifts(Request $request) {
    //     if(@$this->user->id) {
    //         $data['balance_real'] = (!@$this->user->balance_real) ? 0 : @$this->user->balance_real;
    //         $balance_list_server_id = @$request->balance_list_server_id;
    //         if(@$balance_list_server_id) {
    //             $server = Servers::where('id', '=', @$balance_list_server_id)->first();
    //             if(@$server->id) {
    //                 if(@Schema::connection('server_'.@$server->id)->hasTable(@$server->mysql_table_coin)) {
    //                     $balance = @DB::connection('server_'.@$server->id)->table(@$server->mysql_table_coin)->where('uuid', '=', @$this->user->uuid)->first();
    //                     $data['balance_game'] = (!@$balance->money) ? '0' : @$balance->money;
    //                 }  else {
    //                     $data['balance_game'] = '0';
    //                 }
    //             }
    //         }
    //         return response()->json($data);
    //     }
    // }
    public function ratings() {
        $general = $this->general;
        $ratings = RatingsSetting::first();
        $ratings_list = UsersRatings::where('votes', '>=', 1)->orderBy('votes', 'DESC')->limit(20)->get();
        return view('frontend.pages.ratings', compact('general', 'ratings', 'ratings_list'));
    }
    public function ratingsExchange(Request $request) {
        $ratings = RatingsSetting::first();
        $ratings_exchange_type = @$request->ratings_exchange_type;
        $ratings_count_bitcoins = @$request->ratings_count_bitcoins;
        $ratings_count_kits = @$request->ratings_count_kits;
        $ratings_server_id = @$request->ratings_server_id;
        $server = Servers::where('id', '=', @$ratings_server_id)->first();
        if(@$server->id) {
            if(@$this->user->id) {
                if(@Schema::connection('server_'.@$server->id)->hasTable(@$server->mysql_table_coin)) {
                    if(@$ratings_count_bitcoins >= 1 || @$ratings_count_kits >= 1) {

                        if(@$ratings_exchange_type == "bitcoins") {
                            if(@$this->user->balance_game >= @$ratings_count_bitcoins) {
                                $balance_minus = @$this->user->balance_game - @$ratings_count_bitcoins;
                                $balance_plus = @DB::connection('server_'.@$server->id)->table(@$server->mysql_table_coin)->where('username', '=', @$this->user->username)->first();
                                if(!@$balance_plus->username) {
                                    $balance_plus = @DB::connection('server_'.@$server->id)->table(@$server->mysql_table_coin)->insertGetId([
                                        'username' => @$this->user->username,
                                        'balance' => '0'
                                    ]);
                                }
                                $balance_plus = @DB::connection('server_'.@$server->id)->table(@$server->mysql_table_coin)->where('username', '=', @$this->user->username)->update([
                                    'balance' => @$balance_plus->balance + @$ratings_count_bitcoins
                                ]);
                                if(@$balance_plus) {
                                   $this->user->balance_game = $balance_minus; 
                                   $this->user->save();
                                   $data = array(
                                        'type' => 'info',
                                        'message' => '???? ???????????????? '.ToolsController::getPhrase(@$ratings_count_bitcoins, array('??????????????', '????????????????', '??????????????????')).' ???? '.$ratings_count_bitcoins.' '.@$this->general->game_symbol,
                                        'balance' => array(
                                            'bitcoins' => @$balance_minus,
                                            'kits' => @$this->user->kits_game
                                        )
                                    );
                                    return response()->json($data);
                                } else {
                                    $data = array(
                                        'type' => 'warning',
                                        'message' => '???????????? ???????????????? ?? ???????????????????? ??????????????'
                                    );
                                    return response()->json($data);
                                }
                            } else {
                                $data = array(
                                    'type' => 'warning',
                                    'message' => '?? ?????? ???????????????????????? ?????????????????? ?????? ????????????'
                                );
                                return response()->json($data);
                            }
                        }
                        if(@$ratings_exchange_type == "kits") {
                            if(@$this->user->kits_game >= @$ratings_count_kits) {
                                $balance_minus = @$this->user->kits_game - @$ratings_count_kits;
                                $purchases = array(
                                    'type' => 'command',
                                    'purchaseData' => array(
                                        'command' => @$ratings->vote_gift_kit
                                    ),
                                    'displayData' => array(
                                        'name' => "?????????? ???? ??????????",
                                        'lore' => array()
                                    )
                                );
                                $balance_plus = @DB::connection('server_'.@$server->id)->table(@$server->mysql_table_shop)->insert([
                                    'player_name' => @$this->user->username,
                                    'player_uuid' => @$this->user->uuid,
                                    'purchase' => json_encode($purchases)
                                ]);
                                if(@$balance_plus) {
                                    $this->user->kits_game = $balance_minus; 
                                    $this->user->save();
                                    $data = array(
                                        'type' => 'info',
                                        'message' => '???? ???????????????? '.ToolsController::getPhrase(@$ratings_count_kits, array('??????????', '????????????', '??????????????')).' - ???? ?????????? ???? ???????????? '.@$server->name,
                                        'balance' => array(
                                            'bitcoins' => @$this->user->balance_game,
                                            'kits' => @$balance_minus
                                        )
                                    );
                                    return response()->json($data);
                                } else {
                                    $data = array(
                                        'type' => 'warning',
                                        'message' => '???????????? ???????????????? ?? ???????????????????? ??????????????'
                                    );
                                    return response()->json($data);
                                }
                            } else {
                                $data = array(
                                    'type' => 'warning',
                                    'message' => '?? ?????? ???????????????????????? ?????????????? ?????? ????????????'
                                );
                                return response()->json($data);
                            }
                        }
                    } else {
                        $data = array(
                            'type' => 'warning',
                            'message' => '???????????????????? ???? ?????????? ???????? ???????????? ????????'
                        );
                        return response()->json($data);
                    }
                } else {
                    $data = array(
                        'type' => 'warning',
                        'message' => '?????? ?????????????????????? ?? ???????????????????? ??????????????'
                    );
                    return response()->json($data);
                }
            } else {
                $data = array(
                    'type' => 'warning',
                    'message' => '???????????? ????????????????, ???????????????? ????????????????'
                );
                return response()->json($data);
            }
        } else {
            $data = array(
                'type' => 'warning',
                'message' => '?????????????????? ???????????? ???? ???????????? ?? ???????? ????????????'
            );
            return response()->json($data);
        }
    }
    #######################################################################################################################################
    public function cabinet($under_page = '') {
        $data['hash'] = md5(mt_rand(10000000, 99999999));
        $data['general'] = $this->general;
        $data['user'] = @User::where('id', '=', @Auth::user()->id)->first();
        $data['username'] = (!@$data['user']->username) ? 'default' : @$data['user']->username;
        $data['file_skin'] = asset('assets/minecraft/skins')."/".$data['username'].".png?u=".$data['hash'];
        $data['file_cloak'] = asset('assets/minecraft/cloaks')."/".$data['username'].".png?u=".$data['hash'];
        if(!file_exists($_SERVER['DOCUMENT_ROOT']."/assets/minecraft/skins/".$data['username'].".png")) {
            $data['file_skin'] = asset('assets/minecraft/skins')."/default.png?u=".$data['hash'];
        }
        if(!file_exists($_SERVER['DOCUMENT_ROOT']."/assets/minecraft/cloaks/".$data['username'].".png")) {
            $data['file_cloak'] = asset('assets/minecraft/cloaks')."/default.png?u=".$data['hash'];
        }

        $user_privileges = UsersPrivileges::where([
            ['status', '=', 1],
            ['user_id', '=', @Auth::user()->id]
        ])->get();
        $data['servers_prefix'] = [];
        $data['install_skin'] = 1;
        $data['install_cloak'] = 0;
        $data['kits'] = Kits::count();
        $data['ratings'] = RatingsSetting::count();

        foreach($user_privileges as $user_privilege) {
            $privileges = Privileges::where('id', '=', $user_privilege->privilege_id)->first();
            $server = @$privileges->servers;
            if(@$privileges->prefix && @$server->id) {
                $data['servers_prefix'][] = @$server;
            }
            if($privileges->skin_hd) {
                if($privileges->skin_hd) {
                    $data['install_skin_hd'] = 1;
                }
            } else {
                $data['install_skin_hd'] = 0;
            }
            if($privileges->cloak) {
                $data['install_cloak'] = 1;
                if($privileges->cloak_hd) {
                    $data['install_cloak_hd'] = 1;
                }
            } else {
                $data['install_cloak'] = 0;
            }
        }

        if(@$under_page) {
            return view('frontend.pages.cabinet'.$under_page, $data)->render();
        } else {
            return view('frontend.pages.cabinet', $data);
        }
    }
    public function cabinetUploadSkin(Request $request) {
        if(@$request->hasFile('image')) {
            if(@$request->image->getClientOriginalExtension() == 'png') {
                $image_w = @Image::make(@$request->file('image'))->width();
                $image_h = @Image::make(@$request->file('image'))->height();
                $user_privileges = UsersPrivileges::where([
                    ['status', '=', 1],
                    ['user_id', '=', @Auth::user()->id]
                ])->get();
                
                $image_dims = array(
                    0 => array('64','64'),
                    1 => array('32','64')
                );
                
                foreach($user_privileges as $user_privilege) {
                    $privileges = Privileges::where('id', '=', $user_privilege->privilege_id)->first();
                    

                    if($privileges->skin) {
                        $image_dims = array(
                            0 => array('64','64'),
                            1 => array('32','64')
                        );
                        if($privileges->skin_hd) {
                            $image_dims = array(
                                0 => array('64','64','128','256','512','1024'),
                                1 => array('32','64','64','128','256','512')
                            );
                        }
                    } else {
                        $image_dims = array(
                            0 => array('0'),
                            1 => array('0')
                        );
                    }
                }
                if(!in_array($image_w, array('0')) && !in_array($image_h, array('0'))) {
                    if(in_array($image_w, $image_dims[0]) && in_array($image_h, $image_dims[1])) {
                        $is_upload = @Image::make(@$request->file('image')->getRealPath())->save("assets/minecraft/skins/".@Auth::user()->username.".png");
                        if(@$is_upload) {
                            $hash = md5(mt_rand(10000000, 99999999));
                            $data = array(
                                'type' => 'info',
                                'message' => '???????? ?????????? ?????????????? ????????????????',
                                'file' => array(
                                    'skin' => asset('assets/minecraft/skins')."/".@Auth::user()->username.".png?u=".$hash,
                                    'cloak' => asset('assets/minecraft/cloaks')."/".@Auth::user()->username.".png?u=".$hash
                                )
                            );
                            return response()->json($data);
                        } else {
                            $data = array(
                                'type' => 'warning',
                                'message' => '???????? ?????????? ???? ?????? ???????????????? ????-???? ????????????'
                            );
                            return response()->json($data);
                        }
                    } else {
                        $data = array(
                            'type' => 'warning',
                            'message' => '???????? ?????????? ???? ???????????????? ???? ????????????????'
                        );
                        return response()->json($data);
                    }
                } else {
                    $data = array(
                        'type' => 'warning',
                        'message' => '?? ?????? ?????? ?????????????? ?? ???????????????? ??????????'
                    );
                    return response()->json($data);
                }
            } else {
                $data = array(
                    'type' => 'warning',
                    'message' => '???????? ?????????? ???????????? ???????? .PNG'
                );
                return response()->json($data);
            }
        } else {
            $data = array(
                'type' => 'warning',
                'message' => '???????? ?????????? ?????? ???????????????? ???? ????????????'
            );
            return response()->json($data);
        }
    }
    public function cabinetUploadCloak(Request $request) {
        if(@$request->hasFile('image')) {
            if(@$request->image->getClientOriginalExtension() == 'png') {
                $image_w = @Image::make(@$request->file('image'))->width();
                $image_h = @Image::make(@$request->file('image'))->height();
                $user_privileges = UsersPrivileges::where([
                    ['status', '=', 1],
                    ['user_id', '=', @Auth::user()->id]
                ])->get();
                $image_dims = array(
                    0 => array('0'),
                    1 => array('0')
                );
                foreach($user_privileges as $user_privilege) {
                    $privileges = Privileges::where('id', '=', $user_privilege->privilege_id)->first();
                    if($privileges->cloak) {
                        $image_dims = array(
                            0 => array('64','64'),
                            1 => array('32','64')
                        );
                        if($privileges->cloak_hd) {
                            $image_dims = array(
                                0 => array('64','64','128','256','512'),
                                1 => array('32','64','64','128','256')
                            );
                        }
                    } else {
                        $image_dims = array(
                            0 => array('0' => '0'),
                            1 => array('0' => '0')
                        );
                    }
                }
                if(!in_array($image_dims[0][0], array('0')) && !in_array($image_dims[1][0], array('0'))) {
                    if(in_array($image_w, $image_dims[0]) && in_array($image_h, $image_dims[1])) {
                        $is_upload = @Image::make(@$request->file('image')->getRealPath())->save("assets/minecraft/cloaks/".@Auth::user()->username.".png");
                        if(@$is_upload) {
                            $hash = md5(mt_rand(10000000, 99999999));
                            $data = array(
                                'type' => 'info',
                                'message' => '???????? ?????????? ?????????????? ????????????????',
                                'file' => array(
                                    'skin' => asset('assets/minecraft/skins')."/".@Auth::user()->username.".png?u=".$hash,
                                    'cloak' => asset('assets/minecraft/cloaks')."/".@Auth::user()->username.".png?u=".$hash
                                )
                            );
                            return response()->json($data);
                        } else {
                            $data = array(
                                'type' => 'warning',
                                'message' => '???????? ?????????? ???? ?????? ???????????????? ????-???? ????????????'
                            );
                            return response()->json($data);
                        }
                    } else {
                        $data = array(
                            'type' => 'warning',
                            'message' => '???????? ?????????? ???? ???????????????? ???? ????????????????'
                        );
                        return response()->json($data);
                    }
                } else {
                    $data = array(
                        'type' => 'warning',
                        'message' => '?? ?????? ?????? ?????????????? ?? ???????????????? ??????????'
                    );
                    return response()->json($data);
                }
            } else {
                $data = array(
                    'type' => 'warning',
                    'message' => '???????? ?????????? ???????????? ???????? .PNG'
                );
                return response()->json($data);
            }
        } else {
            $data = array(
                'type' => 'warning',
                'message' => '???????? ?????????? ?????? ???????????????? ???? ????????????'
            );
            return response()->json($data);
        }
    }
    public function cabinetPrivilegesList(Request $request) {
        $user = User::where('id', '=', @Auth::user()->id)->first();
        $privileges_list_server_id = $request->privileges_list_server_id;
        $server = Servers::where('id', '=', @$privileges_list_server_id)->first();
        if(@$server->id) {
            $privileges = Privileges::where([
                ['status', '=', 1],
                ['server_id', '=', @$server->id]
            ])->get();
            return view('frontend.pages.cabinet-menu2-privileges', compact('server', 'privileges', 'user'));
        }
    }
    public function cabinetPrivilegesBuys(Request $request) {

        $user = User::where('id', '=', @Auth::user()->id)->first();
        $privileges_buys_privilege_id = $request->privileges_buys_privilege_id;
        
        $privilege = Privileges::where('id', '=', $privileges_buys_privilege_id)->first();
        $server = $privilege->servers;
        $user_privilege = UsersPrivileges::where([
            ['user_id', '=', @$user->id],
            ['server_id', '=', @$server->id]
        ])->first();
        
        // ???????????????? ???????????????? ???? ?????????????? ?????????????????????? ?? ???? ??????????????, ???????????? ???? ????????????????
        //
        $pdo = DB::connection('server_'.@$server->id)->getPdo();

        // ???????????????? ???? ?????????????? ??????????????????
        $privilege_price = @$privilege->price;
        if($request->privileges_buys_promo_id) {
            $promo_id = $request->privileges_buys_promo_id;
            $promo = Promos::where('id', $promo_id)->first();
            
            if($promo->type == 1 || $promo->type == 0) {
                $privilege_price = $new_price = round($privilege->price - ($privilege->price * ($promo->value / 100)));
            }  

            $promo->sales += 1;
            $promo->save();
        }
        if(!$pdo) {
            $data = array(
                'type' => 'warning',
                'message' => '?????? ???????????????????? ?? ?????????? ???????????? ??????????????'
            );
            return response()->json($data);
        }
        
        if(!$privilege->id) {
            $data = array(
                'type' => 'warning',
                'message' => '???????????????????? ???? ??????????????, ???????????????? ????????????????'
            );
            return response()->json($data);
        }
        // if(@$user_privilege->privilege_id == $privilege->id) {
        //     $data = array(
        //         'type' => 'warning',
        //         'message' => '???????????????????? '.$privilege->name.' ?????? ??????????????'
        //     );
        //     return response()->json($data);
        // }
        if(!$user->id) {
            $data = array(
                'type' => 'warning',
                'message' => '???????????? ??????????????, ???????????????? ????????????????'
            );
            return response()->json($data);
        }
        if(!$server->id) {
            $data = array(
                'type' => 'warning',
                'message' => '???????????? ???? ????????????, ???????????????? ????????????????'
            );
            return response()->json($data);
        }
        
        if(@$user->balance_real < @$privilege_price) {
            $data = array(
                'type' => 'warning',
                'message' => '?? ?????? ?????????????????????????? ???????????? ?????? ??????????????'
            );
            return response()->json($data);
        }

        // ???????? ???????????????? -1, ???? ???????????????????? ???????????????? ???????????????? (?????? ???????????????? time)
        if(@$privilege->term_days != -1) {
            $purchases = array(
                'type' => 'group',
                'purchaseData' => array(
                    'group' => strtolower(@$privilege->name),
                    'time' => 86400 * @$privilege->term_days
                ),
                'displayData' => array(
                    'name' => @$privilege->name,
                    'lore' => array()
                )
            );
        }
        else {
            $purchases = array(
                'type' => 'group',
                'purchaseData' => array(
                    'group' => strtolower(@$privilege->name)
                ),
                'displayData' => array(
                    'name' => @$privilege->name,
                    'lore' => array()
                )
            );
        }
        // if(@$user_privilege->privilege_id == $privilege->id) {
        
        if(@$privilege->term_days != -1) {
            $term_unix = time() + @$purchases['purchaseData']['time'];
            $days_operation = @$term_unix - time();
            $days_remains = floor($days_operation / (60 * 60 * 24));
        }
        else {
            $term_unix = -1;
            $days_operation = -1;
            $days_remains = -1;
        }
        $privilege_check = UsersPrivileges::where([
            ['user_id', '=', @$user->id],
            ['server_id', '=', @$server->id],
            ['privilege_id', '=', @$privilege->id]
        ])->first();
        if(@$privilege_check->id) {
            UsersPrivileges::where('id', '=', @$privilege_check->id)->update([
                'privilege_term' => @$privilege_check->privilege_term + @$purchases['purchaseData']['time'],
                'status' => 1
            ]);
        } else {
            UsersPrivileges::where([
                ['user_id', '=', @$user->id],
                ['server_id', '=', @$server->id]
            ])->delete();
            UsersPrivileges::create([
                'user_id' => @$user->id,
                'server_id' => @$server->id,
                'privilege_id' => @$privilege->id,
                'privilege_term' => $term_unix,
                'privilege_price' => @$privilege_price,
                'status' => 1
            ]);
        }
        DB::connection('server_'.@$server->id)->table(@$server->mysql_table_shop)->insert([
            'player_name' => $user->username,
            'player_uuid' => $user->uuid,
            'purchase' => json_encode($purchases)
        ]);


        $user->balance_real = number_format($user->balance_real - @$privilege_price, 2, '.', '');
        $user->save();
        // ???????????????? ???? "??????????????????????????" ????????????????????
        if(@$privilege->term_days != -1) {
            $term = date("d.m.Y H:i", @$term_unix);
        }
        else {
            $term = -1;
        }
        $data = array(
            'type' => 'info',
            'message' => '???? ?????????????? ?????????????????? '.@$privilege->display_name.', ?????????????? '.@$privilege_price.' '.@$this->general->currency_symbol,
            'html' => array(
                'menu1' => self::cabinet('-menu1'),
                'menu2' => self::cabinet('-menu2'),
                'menu3' => self::cabinet('-menu3'),
                'menu4' => self::cabinet('-menu4'),
                'privilege' => array(
                    'name' => @$privilege->name,
                    'term' => $term,
                    'days' => (@$days_remains == 0) ? '0' : @$days_remains
                )
            )
        );
        if(@$user_privilege->privilege_id == $privilege->id) {
            $data['message'] = '???? ?????????????? ???????????????? '.@$privilege->display_name.', ?????????????? '.@$privilege_price.' '.@$this->general->currency_symbol;
        }
        return response()->json($data);
    }
    public function cabinetPrefixList(Request $request) {
        $user = User::where('id', '=', @Auth::user()->id)->first();
        $prefix_list_server_id = $request->prefix_list_server_id;
        $server = Servers::where('id', '=', @$prefix_list_server_id)->first();
        return view('frontend.pages.cabinet-menu3-prefix', compact('server', 'user'));
    }
    public function cabinetPrefixSave(Request $request) {
        $user = User::where('id', '=', @Auth::user()->id)->first();
        $chose1 = @$request->chose1;
        $chose2 = @$request->chose2;
        $chose3 = @$request->chose3;
        $prefix = @$request->prefix;
        $server = Servers::where('id', '=', @$request->server_id)->first();
        if(!$server->id) {
            $data = array(
                'type' => 'warning',
                'message' => '???????????? ???? ????????????, ???????????????? ????????????????'
            );
            return response()->json($data);
        }
        if(!@$prefix) {
            $data = array(
                'type' => 'warning',
                'message' => '?????????????? ???????????????????? ???????????????? ??????????????'
            );
            return response()->json($data);
        }
        if(strlen(@$prefix) < 4) {
            $data = array(
                'type' => 'warning',
                'message' => '?????????????? ???? ?????????? ???????? ???????????? 4 ????????????????'
            );
            return response()->json($data);
        }
        if(strlen(@$prefix) > 12) {
            $data = array(
                'type' => 'warning',
                'message' => '?????????????? ???? ?????????? ???????? ???????????? 12 ????????????????'
            );
            return response()->json($data);
        }
        $system_color = array(
            'black',
            'darkblue',
            'darkgreen',
            'turquoise',
            'purple',
            'gold',
            'gray',
            'darkgray',
            'blue',
            'green',
            'aqua',
            'magenta',
            'yellow',
            'white'
        );
        $system_color_pref = false;
        $system_color_nick = false;
        $system_color_msgs = false;
        if(!in_array(@$chose1, @$system_color)) {
            $data = array(
                'type' => 'warning',
                'message' => '?????????????????? ???????? ???????????????? ???? ???????????? ?? ??????????????'
            );
            return response()->json($data);
        }
        if(!in_array(@$chose2, @$system_color)) {
            $data = array(
                'type' => 'warning',
                'message' => '?????????????????? ???????? ???????? ???? ???????????? ?? ??????????????'
            );
            return response()->json($data);
        }
        if(!in_array(@$chose3, @$system_color)) {
            $data = array(
                'type' => 'warning',
                'message' => '?????????????????? ???????? ?????????????????? ???? ???????????? ?? ??????????????'
            );
            return response()->json($data);
        }
        switch($chose1) {
            case 'black':
                $chose1 = "&0";
            break;
            case 'darkblue':
                $chose1 = "&1";
            break;
            case 'darkgreen':
                $chose1 = "&2";
            break;
            case 'turquoise':
                $chose1 = "&3";
            break;
            case 'purple':
                $chose1 = "&5";
            break;
            case 'gold':
                $chose1 = "&6";
            break;
            case 'gray':
                $chose1 = "&7";
            break;
            case 'darkgray':
                $chose1 = "&8";
            break;
            case 'blue':
                $chose1 = "&9";
            break;
            case 'green':
                $chose1 = "&a";
            break;
            case 'aqua':
                $chose1 = "&b";
            break;
            case 'magenta':
                $chose1 = "&d";
            break;
            case 'white':
                $chose1 = "&f";
            break;
        }
        switch($chose2) {
            case 'black':
                $chose2 = "&0";
            break;
            case 'darkblue':
                $chose2 = "&1";
            break;
            case 'darkgreen':
                $chose2 = "&2";
            break;
            case 'turquoise':
                $chose2 = "&3";
            break;
            case 'purple':
                $chose2 = "&5";
            break;
            case 'gold':
                $chose2 = "&6";
            break;
            case 'gray':
                $chose2 = "&7";
            break;
            case 'darkgray':
                $chose2 = "&8";
            break;
            case 'blue':
                $chose2 = "&9";
            break;
            case 'green':
                $chose2 = "&a";
            break;
            case 'aqua':
                $chose2 = "&b";
            break;
            case 'magenta':
                $chose2 = "&d";
            break;
            case 'white':
                $chose2 = "&f";
            break;
        }
        switch($chose3) {
            case 'black':
                $chose3 = "&0";
            break;
            case 'darkblue':
                $chose3 = "&1";
            break;
            case 'darkgreen':
                $chose3 = "&2";
            break;
            case 'turquoise':
                $chose3 = "&3";
            break;
            case 'purple':
                $chose3 = "&5";
            break;
            case 'gold':
                $chose3 = "&6";
            break;
            case 'gray':
                $chose3 = "&7";
            break;
            case 'darkgray':
                $chose3 = "&8";
            break;
            case 'blue':
                $chose3 = "&9";
            break;
            case 'green':
                $chose3 = "&a";
            break;
            case 'aqua':
                $chose3 = "&b";
            break;
            case 'magenta':
                $chose3 = "&d";
            break;
            case 'white':
                $chose3 = "&f";
            break;
        }
        $empty = ' ';
        $colon = '&f:';
        $bracket1 = '&f[';
        $bracket2 = '&f]';
        $prefix_mine = $bracket1.$chose1.$prefix.$bracket2.$chose2.$empty;
        $prefix_full = $prefix_mine.@$user->username.$colon.$chose3;
        $prefixes_check = UsersPrefixes::where([
            ['user_id', '=', @$user->id],
            ['server_id', '=', @$request->server_id]
        ])->first();
        if(@$prefixes_check->id) {
            UsersPrefixes::where('id', '=', @$prefixes_check->id)->update([
                'prefix_name' => @$prefix,
                'prefix_mine' => @$prefix_mine,
                'prefix_full' => @$prefix_full
            ]);
        } else {
            UsersPrefixes::create([
                'user_id' => @$user->id,
                'server_id' => @$request->server_id,
                'prefix_name' => @$prefix,
                'prefix_mine' => @$prefix_mine,
                'prefix_full' => @$prefix_full
            ]);
        }
        $prefix_cmd = @$this->general->prefix_cmd;
        $prefix_cmd = str_replace("{USER}", @$user->username, @$prefix_cmd);
        $prefix_cmd = str_replace("[USER]", @$user->username, @$prefix_cmd);
        $prefix_cmd = str_replace("%USER%", @$user->username, @$prefix_cmd);
        $prefix_cmd = str_replace("{user}", @$user->username, @$prefix_cmd);
        $prefix_cmd = str_replace("[user]", @$user->username, @$prefix_cmd);
        $prefix_cmd = str_replace("%user%", @$user->username, @$prefix_cmd);
        $prefix_cmd = str_replace("{NICK}", @$user->username, @$prefix_cmd);
        $prefix_cmd = str_replace("[NICK]", @$user->username, @$prefix_cmd);
        $prefix_cmd = str_replace("%NICK%", @$user->username, @$prefix_cmd);
        $prefix_cmd = str_replace("{nick}", @$user->username, @$prefix_cmd);
        $prefix_cmd = str_replace("[nick]", @$user->username, @$prefix_cmd);
        $prefix_cmd = str_replace("%nick%", @$user->username, @$prefix_cmd);
        $prefix_cmd = str_replace("{PLAYER}", @$user->username, @$prefix_cmd);
        $prefix_cmd = str_replace("[PLAYER]", @$user->username, @$prefix_cmd);
        $prefix_cmd = str_replace("%PLAYER%", @$user->username, @$prefix_cmd);
        $prefix_cmd = str_replace("{player}", @$user->username, @$prefix_cmd);
        $prefix_cmd = str_replace("[player]", @$user->username, @$prefix_cmd);
        $prefix_cmd = str_replace("%player%", @$user->username, @$prefix_cmd);
        $prefix_cmd = str_replace("{prefix}", @$prefix_mine, @$prefix_cmd);
        $prefix_cmd = str_replace("[prefix]", @$prefix_mine, @$prefix_cmd);
        $prefix_cmd = str_replace("%prefix%", @$prefix_mine, @$prefix_cmd);
        $purchases = array(
            'type' => 'command',
            'purchaseData' => array(
                'command' => @$prefix_cmd
            ),
            'displayData' => array(
                'name' => "??????????????",
                'lore' => array()
            )
        );
        DB::connection('server_'.@$server->id)->table(@$server->mysql_table_shop)->insert([
            'player_name' => $user->username,
            'player_uuid' => $user->uuid,
            'purchase' => json_encode($purchases)
        ]);
        $data = array(
            'type' => 'info',
            'message' => '?????????????? ?????????????? ????????????????'
        );
        return response()->json($data);

    }
    public function cabinetKitsList(Request $request) {
        $user = User::where('id', '=', @Auth::user()->id)->first();
        $kits_list_server_id = $request->kits_list_server_id;
        $server = Servers::where('id', '=', @$kits_list_server_id)->first();
        if(@$server->id) {
            $kits = Kits::where([
                ['status', '=', 1],
                ['server_id', '=', @$server->id]
            ])->get();
        }
        return view('frontend.pages.cabinet-menu4-kits', compact('server', 'kits', 'user'));
    }
    public function cabinetKitsBuys(Request $request) {
        $user = User::where('id', '=', @Auth::user()->id)->first();
        $kits_buys_kit_id = $request->kits_buys_kit_id;
        $kits_buys_kit_server_id = $request->kits_buys_kit_server_id;
        $kits_buys_kit_amount = $request->kits_buys_kit_amount;
        $kit = Kits::where('id', '=', $kits_buys_kit_id)->first();
        $server = $kit->servers;
        if(!$kit->id) {
            $data = array(
                'type' => 'warning',
                'message' => '?????????? ???? ????????????, ???????????????? ????????????????'
            );
            return response()->json($data);
        }
        if(!$user->id) {
            $data = array(
                'type' => 'warning',
                'message' => '???????????? ??????????????, ???????????????? ????????????????'
            );
            return response()->json($data);
        }
        if(!$server->id) {
            $data = array(
                'type' => 'warning',
                'message' => '???????????? ???? ????????????, ???????????????? ????????????????'
            );
            return response()->json($data);
        }
        $price = @$kit->price * @$kits_buys_kit_amount;
        // ???????????????? ???? ?????????????? ??????????????????
        if($request->kits_buys_promo_id) {
            $promo_id = $request->kits_buys_promo_id;
            $promo = Promos::where('id', $promo_id)->first();
            if($promo->type == 3 || $promo->type == 0) {
                $price = $new_price = round($price- ($price * ($promo->value / 100)));
            }
            $promo->sales += 1;
            $promo->save();
        }
        if(@$user->balance_real < $price) {
            $data = array(
                'type' => 'warning',
                'message' => '?? ?????? ?????????????????????????? ???????????? ?????? ??????????????'
            );
            return response()->json($data);
        }
        if(!@Schema::connection('server_'.@$server->id)->hasTable(@$server->mysql_table_shop)) {
            $data = array(
                'type' => 'warning',
                'message' => '?????????????? '.@$server->mysql_table_shop.' ???? ??????????????'
            );
            return response()->json($data);
        }
        $server_cmd = @$kit->server_cmd;
        $server_cmd = str_replace("{USER}", @$user->username, @$server_cmd);
        $server_cmd = str_replace("[USER]", @$user->username, @$server_cmd);
        $server_cmd = str_replace("%USER%", @$user->username, @$server_cmd);
        $server_cmd = str_replace("{user}", @$user->username, @$server_cmd);
        $server_cmd = str_replace("[user]", @$user->username, @$server_cmd);
        $server_cmd = str_replace("%user%", @$user->username, @$server_cmd);
        $server_cmd = str_replace("{NICK}", @$user->username, @$server_cmd);
        $server_cmd = str_replace("[NICK]", @$user->username, @$server_cmd);
        $server_cmd = str_replace("%NICK%", @$user->username, @$server_cmd);
        $server_cmd = str_replace("{nick}", @$user->username, @$server_cmd);
        $server_cmd = str_replace("[nick]", @$user->username, @$server_cmd);
        $server_cmd = str_replace("%nick%", @$user->username, @$server_cmd);
        $server_cmd = str_replace("{PLAYER}", @$user->username, @$server_cmd);
        $server_cmd = str_replace("[PLAYER]", @$user->username, @$server_cmd);
        $server_cmd = str_replace("%PLAYER%", @$user->username, @$server_cmd);
        $server_cmd = str_replace("{player}", @$user->username, @$server_cmd);
        $server_cmd = str_replace("[player]", @$user->username, @$server_cmd);
        $server_cmd = str_replace("%player%", @$user->username, @$server_cmd);
        $purchases = array(
            'type' => 'command',
            'purchaseData' => array(
                'command' => @$server_cmd
            ),
            'displayData' => array(
                'name' => "?????????? ".@$kit->name,
                'lore' => array()
            )
        );
        DB::connection('server_'.@$server->id)->table(@$server->mysql_table_shop)->insert([
            'player_name' => $user->username,
            'player_uuid' => $user->uuid,
            'purchase' => json_encode($purchases)
        ]);
        $user->balance_real = number_format($user->balance_real - @$price, 2, '.', '');
        $user->save();
        $data = array(
            'type' => 'info',
            'message' => '?????????????? ??????????????, ?????????????? '.@$price.' ??????.'
        );
        return response()->json($data);
    }
    #######################################################################################################################################
    public function storets() {
        $general = $this->general;
        return view('frontend.pages.storets', compact('general'));
    }
    public function storetsLoad(Request $request) {
        $general = $this->general;
        $storets_list_server_id = @$request->storets_list_server_id;
        $storets_list_catogory_id = @$request->storets_list_catogory_id;
        if(@$storets_list_server_id && @$storets_list_catogory_id) {
            $items = Items::where([
                ['server_id', '=', @$storets_list_server_id],
                ['category_id', '=', @$storets_list_catogory_id]
            ])->get();
            return view('frontend.pages.storets-list', compact('general', 'items'));
        } else {
            $categories = Category::where([
                ['status', '=', 1],
                ['server_id', '=', @$storets_list_server_id]
            ])->get();
            return $categories;
        }
    }
    public function storetsBuys(Request $request) {
        $general = $this->general;
        $storets_item_id = @$request->storets_item_id;
        $storets_item_amount = @$request->storets_item_amount;
        $user = User::where('id', '=', @Auth::user()->id)->first();
        $item = Items::where('id', '=', $storets_item_id)->first();
        $server = $item->servers;
        if(!$item->id) {
            $data = array(
                'type' => 'warning',
                'message' => '?????????????? ???? ????????????, ???????????????? ????????????????'
            );
            return response()->json($data);
        }
        if(!$user->id) {
            $data = array(
                'type' => 'warning',
                'message' => '???????????? ??????????????, ???????????????? ????????????????'
            );
            return response()->json($data);
        }
        if(!$server->id) {
            $data = array(
                'type' => 'warning',
                'message' => '???????????? ???? ????????????, ???????????????? ????????????????'
            );
            return response()->json($data);
        }
        if($storets_item_amount <= 0) {
            $data = array(
                'type' => 'warning',
                'message' => '??????-???? ???? ?????????? ???????? ???????????? 1 ????'
            );
            return response()->json($data);
        }
        if(!@Schema::connection('server_'.@$server->id)->hasTable(@$server->mysql_table_shop)) {
            $data = array(
                'type' => 'warning',
                'message' => '?????????????? '.@$server->mysql_table_shop.' ???? ??????????????'
            );
            return response()->json($data);
        }
        $price = number_format(@$item->price * $storets_item_amount, 2, '.', '');
        // ???????????????? ???? ?????????????? ??????????????????
        if($request->storets_item_promo_id) {
            $promo_id = $request->storets_item_promo_id;
            $promo = Promos::where('id', $promo_id)->first();
            if($promo->type == 2 || $promo->type == 0) {
                $price = $new_price = round($price- ($price * ($promo->value / 100)));
            }
            $promo->sales += 1;
            $promo->save();
        }
        $count = $storets_item_amount * $item->count;
        if(@$user->balance_real < $price) {
            $data = array(
                'type' => 'warning',
                'message' => '?? ?????? ?????????????????????????? ???????????? ?????? ??????????????'
            );
            return response()->json($data);
        }
        $item_id = @$item->item_id;
        $item_id = explode(":", @$item_id);
        if(@$item->enchants) {
            $enchants = json_decode(@$item->enchants, true);
            $purchases = array(
                'type' => 'item',
                'purchaseData' => array(
                    'minecraftId' => @$item_id[0],
                    'dataValue' => (!@$item_id[1]) ? 0 : @$item_id[1],
                    'count' => (!@$count) ? 8 : @$count,
                    'name' => @$item->name,
                    'lore' => array(),
                    'enchants' => $enchants
                ),
                'displayData' => array(
                    'name' => @$item->name,
                    'lore' => array()
                )
            );
        }
        else {
            $purchases = array(
                'type' => 'item',
                'purchaseData' => array(
                    'minecraftId' => @$item_id[0],
                    'dataValue' => (!@$item_id[1]) ? 0 : @$item_id[1],
                    'count' => (!@$count) ? 8 : @$count,
                    'name' => @$item->name,
                    'lore' => array()
                ),
                'displayData' => array(
                    'name' => @$item->name,
                    'lore' => array()
                )
            );
        }

        DB::connection('server_'.@$server->id)->table(@$server->mysql_table_shop)->insert([
            'player_name' => $user->username,
            'player_uuid' => $user->uuid,
            'purchase' => json_encode($purchases)
        ]);
        $user->balance_real = number_format($user->balance_real - $price, 2, '.', '');
        $user->save();
        $data = array(
            'type' => 'info',
            'message' => '?????????????? ??????????????, ?????????????? '.$price.' ??????.'
        );
        return response()->json($data);
    }
    #######################################################################################################################################
    public function banlist(Request $request) {
        $general = $this->general;
        if(@$request->action == "list") {
            if($request->server_id) {
                $banlist = Servers::banlist($request->server_id);
                return view('frontend.pages.banlist-list', compact('general', 'banlist'));
            }
        } else {
            return view('frontend.pages.banlist', compact('general'));
        }
    }
    #######################################################################################################################################


    public function forgotPass(Request $request) {
        $general = $this->general;
        $this->validate($request, [
            'email' => 'required'
        ], [
                'email.required' => 'E-Mail ?????????????????????? ?????? ????????????????????'
            ]
        );
        $user = User::where('email', $request->email)->first();
        if($user == null) {
            return back()->with('alert', '???????????????? ?????????? ?????????????????????? ??????????');
        } else {
            $code = str_random(30);
            PasswordReset::create(
                ['email' => $user->email, 'token' => $code]
            );
            $data_text = "
                ???????????? ???????????? ???? ???????????????????????????? ????????????.
                <br>
                ???????????????????????????? ????????????????: ".$user->username."
                <br>
                <table class='table-color'>
                    <tr>
                        <th>
                            ???????????? ???? ?????????? ????????????: <a href='".url('/')."/reset/".$code."' target='_Blank' style='color:#fff;'>".url('/')."/reset/".$code."</a>
                        </th>
                    </tr>
                </table>
            ";
            @MailerController::mailSend(array(
                'to' => $user->email,
                'subject' => '?????????? ????????????',
                'message' => view('mailer.dashboard', compact('general', 'user', 'data_text')),
                'html' => true
            ));
            return redirect()->route('login')->with('success', '???????????? ???? ?????????? ????????????, ?????????????? ???????????????????? ???? ???????? ??????????');
        }
    }
    public function resetLink($code) {
        $reset = PasswordReset::where('token', $code)->orderBy('created_at', 'desc')->first();
        if(is_null($reset)) {
            return redirect()->route('login')->with('alert', '???????????????????????????????? ???????????? ?????? ???????????? ????????????');
        } else {
            if ($reset->status == 1 || Carbon::now() > $reset->created_at->addHour(1)) {
                return redirect()->route('login')->with('alert', '???????????????????????????????? ???????????? ?????? ???????????? ????????????');
            } else {
                return view('auth.passwords.reset', compact('reset'));
            }
        }
    }
    public function passwordReset(Request $request) {
        $general = $this->general;
        $this->validate($request, [
                'token' => 'required',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|min:6'
        ], [
                'token.required' => '?????????? ???? ??????????????????, ???????????????? ????????????????',
                'password.required' => '???????? ???????????? ???? ??????????????????',
                'password.min' => '?????????????????????? ???????????? ???????????? 6 ????????????????',
                'password_confirmation.required' => '???????? ?????????????? ???????????? ???? ??????????????????',
                'password_confirmation.min' => '?????????????????????? ???????????? ?????????????? ???????????? 6 ????????????????'
            ]
        );
        $reset = PasswordReset::where('token', $request->token)->orderBy('created_at', 'desc')->first();
        $user = User::where('email', $reset->email)->first();
        if($reset->status == 1) {
            return redirect()->route('login')->with('alert', '???????????????????????????????? ???????????? ?????? ???????????? ????????????');
        } else {
            if($request->password == $request->password_confirmation) {
                $user->password = bcrypt($request->password);
                $user->save();
                PasswordReset::where('email', $user->email)->where('token', $request->token)->update(['status' => 1]);
                $data_text = "
                    ???????????? ?????????????? ??????????????.
                    <br>
                    <br>
                    ??????????: ".$user->username."
                    <br>
                    ????????????: ".$request->password."
                    <br>
                    <br>
                    ?? ??????????????????, ?????????????????????????? ?????????????? ".$this->general->title."!
                ";
                @MailerController::mailSend(array(
                    'to' => $user->email,
                    'subject' => '?????????? ????????????',
                    'message' => view('mailer.dashboard', compact('general', 'user', 'data_text')),
                    'html' => true
                ));
                // ???????????????? ???????????? ???????????????????????? ?????????? ?????????? ????????????
                DB::table('sessions')->where('user_id', '=', $user->id)->delete();
                @Auth::logout();
                @Auth::attempt([
                    'username' => $user->username,
                    'password' => $request->password
                ], true);
                return redirect()->route('login')->with('success', '???????????? ?????????????? ??????????????');
            } else {
                return back()->with('alert', '???????????? ???? ??????????????????');
            }
        }
    }

    public function passwordResetCabinet(Request $request) {
        $this->validate($request, [
                'password' => 'required|min:6',
                'password_confirmation' => 'required|min:6'
        ], [
                'password.required' => '???????? ???????????? ???? ??????????????????',
                'password.min' => '?????????????????????? ?????????? ???????????? 6 ????????????????',
                'password_confirmation.required' => '???????? ?????????????? ???????????? ???? ??????????????????',
                'password_confirmation.min' => '?????????????????????? ?????????? ?????????????? ???????????? 6 ????????????????'
            ]
        );
        $user = @Auth::user();
            if($request->password == $request->password_confirmation) {
                $user->password = bcrypt($request->password);
                $user->save();
                $data_text = "
                    ???????????? ?????????????? ??????????????.
                    <br>
                    <br>
                    ??????????: ".$user->username."
                    <br>
                    ????????????: ".$request->password."
                    <br>
                    <br>
                    ?? ??????????????????, ?????????????????????????? ?????????????? ".$this->general->title."!
                ";
                @MailerController::mailSend(array(
                    'to' => $user->email,
                    'subject' => '?????????? ????????????',
                    'message' => view('mailer.dashboard', compact('general', 'user', 'data_text')),
                    'html' => true
                ));

                // ???????????????? ???????????? ???????????????????????? ?????????? ?????????? ????????????
                DB::table('sessions')->where('user_id', '=', $user->id)->delete();
                @Auth::logout();
                @Auth::attempt([
                    'username' => $user->username,
                    'password' => $request->password
                ], true);

                return redirect()->route('cabinet')->with('success', '???????????? ?????????????? ??????????????');
            } else {
                return back()->with('alert', '???????????? ???? ??????????????????');
            }
    }

    public function paymentshandler(Request $request) {
        switch(@$request->name) {
            case 'unitpay':
                $gate = new GatewayUnitpay();
                return $gate->payment_handler($request);
            break;
            case 'freekassa':
                $gate = new GatewayFreekassa();
                return $gate->payment_handler($request);
            break;
            case 'qiwi':
                $gate = new GatewayQiwi();
                return $gate->payment_handler($request);
            break;
            
            default:
                $data = array(
                    'type' => 'warning',
                    'message' => 'Payment method not found in system'
                );
                return response()->json($data);
            break;
        }
    }

    public function super_unique($array, $key) {
       $temp_array = [];
       foreach ($array as &$v) {
           if (!isset($temp_array[$v[$key]]))
           $temp_array[$v[$key]] =& $v;
       }
       $array = array_values($temp_array);
       return $array;

    }

    // ?????????????? ???????????????????? 
    public function promosCheck(Request $request)
    {
        $promo = Promos::where('code', $request->code)->first();
        if(!$promo) {
            return response()->json(['desc' => '???????????? ?????????????????? ???? ????????????????????']);
        }
        if($promo->type != $request->type && $promo->type != 0) {
            return response()->json(['desc' => '???????????????? ???? ???????????????? ?? ?????????????? ????????????']);
        }
        $value = $promo->value;
        $new_price = 0;

        if($request->type == 1) {
            $privilege = Privileges::where('id', $request->id)->first();
            $new_price = round($privilege->price - ($privilege->price * ($value / 100)));
        }
        elseif($request->type == 2) {
            $item = Items::where('id', $request->id)->first();
            $new_price = round($item->price - ($item->price * ($value / 100)));
        }
        elseif($request->type == 3) {
            $kit = Kits::where('id', $request->id)->first();
            $new_price = round($kit->price - ($kit->price * ($value / 100)));
        }

        return response()->json(['desc' => $promo->desc, 'new_price' => $new_price, 'promo_id' => $promo->id, 'promo_value' => $promo->value]);
    }
}
