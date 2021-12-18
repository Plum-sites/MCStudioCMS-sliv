<?php

namespace App\Http\Controllers\Admin;

use DB;
use Mail;
use Auth;
use Image;
use Session;

use App\User;
use App\UserAuth;
use App\UsersNotify;
use App\UsersPrivileges;
use App\Servers;
use App\ServersDB;
use App\Privileges;
use App\Kits;
use App\Promos;

use App\Items;
use App\Category;
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
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;


class AdminController extends Controller {

    #######################################################################################################################################
    public function __construct() {
        Servers::servers();
        $this->general = GeneralSetting::first();
    }
    public function hasherstring($string = 'default') {
        $hash = md5(md5($string.":".time()).":".md5($string.":".str_random(32)));
        $hash = substr($hash, 0, 16);
        return $hash;
    }
    #######################################################################################################################################
    public function settingList() {
        $item = GeneralSetting::first();
        $unitpay = new GatewayUnitpay();
        $freekassa = new GatewayFreekassa();
        // $gateways_list[] = $unitpay->gateway();
        $gateways_list = array(
            1 => $unitpay->gateway(),
            2 => $freekassa->gateway()
        );
        return view('admin.settingList', compact('item', 'gateways_list'));
    }
    public function smtp() {
        $item = GeneralSetting::first();

        return view('admin.smtp');
    }

    public function smtpSave(Request $request){
        try {
            config(['mail.host' => $request->mail_host]);
            config(['mail.port' => $request->mail_port]);
            config(['mail.encryption' => $request->mail_encryption]);
            config(['mail.username' => $request->mail_username]);
            config(['mail.password' => $request->mail_password]);
        }
        catch(Exception $e) {
            session()->flash('danger', 'Ошибка ');
        }

        //Config::set('mail.host', $request->mail_host);
        session()->flash('success', 'Настройки SMTP успешно сохранены');
        return back();
    }

    public function settingListSave(Request $request){
        $general = GeneralSetting::first();
        $general->title = (!@$request->title) ? "Title" : @$request->title;
        $general->e_sender = (!@$request->e_sender) ? "no-reply@example.com" : @$request->e_sender;
        $general->description = (!@$request->description) ? "Description" : @$request->description;
        $general->currency_symbol = (!@$request->currency_symbol) ? "rubs" : @$request->currency_symbol;
        $general->game_symbol = (!@$request->game_symbol) ? "coin" : @$request->game_symbol;
        $general->exch_rubs_to_coin = (!@$request->exch_rubs_to_coin) ? "2" : @$request->exch_rubs_to_coin;
        $general->gateway_use = (@$request->gateway_use == 0) ? "0" : @$request->gateway_use;
        $general->reg = @$request->reg =="1" ? 1 : 0;
        $general->site_offline = @$request->site_offline =="1" ? 1 : 0;
        $general->launcher_link = (!@$request->launcher_link) ? "/launcher.exe" : @$request->launcher_link;
        $general->launcher_link_jar = (!@$request->launcher_link_jar) ? "/launcher.jar" : @$request->launcher_link_jar;
        // $general->email_verification = @$request->emailver == "1" ? 1 : 0;
        $general->email_notification = @$request->emailnotf == "1" ? 1 : 0;
        $general->vk_client_id = (!@$request->vk_client_id) ? "client_id" : @$request->vk_client_id;
        $general->vk_client_secret = (!@$request->vk_client_secret) ? "client_secret" : @$request->vk_client_secret;
        $general->vk_redirect_uri = (!@$request->vk_redirect_uri) ? "redirect_uri" : @$request->vk_redirect_uri;
        $general->vk_group_id = (!@$request->vk_group_id) ? "172494684" : @$request->vk_group_id;
        $general->discord_server_id = (!@$request->discord_server_id) ? null : @$request->discord_server_id;
        $general->vk_group_token = (!@$request->vk_group_token) ? "290e6f14206f0082fedae22d1bc4547b67676b7a36cae75cee21d5199100d045dd2e0afe3bdfd3fc15cf8" : @$request->vk_group_token;
        $general->vk_output_count = (!@$request->vk_output_count) ? "10" : @$request->vk_output_count;

        $general->sw_exchange = (!@$request->sw_exchange) ? "false" : @$request->sw_exchange;
        $general->sw_ratings = (!@$request->sw_ratings) ? "false" : @$request->sw_ratings;
        $general->sw_banlist = (!@$request->sw_banlist) ? "false" : @$request->sw_banlist;
        $general->sw_kits = (!@$request->sw_kits) ? "false" : @$request->sw_kits;
        $general->sw_prefixes = (!@$request->sw_prefixes) ? "false" : @$request->sw_prefixes;
        $general->sw_shop = (!@$request->sw_shop) ? "false" : @$request->sw_shop;

        $general->save();

        session()->flash('success', 'Настройки системы успешно сохранены');
        return back();
    }
    #######################################################################################################################################
    public function ratingsList() {
        $item = RatingsSetting::first();
        return view('admin.ratingsList', compact('item'));
    }
    public function ratingsListSave(Request $request){
        $general = RatingsSetting::first();
        if($general) {
            $general->vote_gift_type = (!@$request->vote_gift_type) ? "1" : @$request->vote_gift_type;
            $general->vote_gift_count = (!@$request->vote_gift_count) ? "1" : @$request->vote_gift_count;
            $general->vote_gift_kit = (!@$request->vote_gift_kit) ? "kit vote" : @$request->vote_gift_kit;
            $general->secret_mcrate = (!@$request->secret_mcrate) ? "secret" : @$request->secret_mcrate;
            $general->secret_topcraft = (!@$request->secret_topcraft) ? "secret" : @$request->secret_topcraft;
            $general->secret_minecraftrating = (!@$request->secret_minecraftrating) ? "0" : @$request->secret_minecraftrating;
            $general->link_mcrate = (!@$request->link_mcrate) ? "link" : @$request->link_mcrate;
            $general->link_topcraft = (!@$request->link_topcraft) ? "link" : @$request->link_topcraft;
            $general->link_minecraftrating = (!@$request->link_minecraftrating) ? "0" : @$request->link_minecraftrating;
            $general->save();
        }
        else {
            $general = new RatingsSetting;
            $general->vote_gift_type = (!@$request->vote_gift_type) ? "1" : @$request->vote_gift_type;
            $general->vote_gift_count = (!@$request->vote_gift_count) ? "1" : @$request->vote_gift_count;
            $general->vote_gift_kit = (!@$request->vote_gift_kit) ? "kit vote" : @$request->vote_gift_kit;
            $general->secret_mcrate = (!@$request->secret_mcrate) ? "secret" : @$request->secret_mcrate;
            $general->secret_topcraft = (!@$request->secret_topcraft) ? "secret" : @$request->secret_topcraft;
            $general->secret_minecraftrating = (!@$request->secret_minecraftrating) ? "0" : @$request->secret_minecraftrating;
            $general->link_mcrate = (!@$request->link_mcrate) ? "link" : @$request->link_mcrate;
            $general->link_topcraft = (!@$request->link_topcraft) ? "link" : @$request->link_topcraft;
            $general->link_minecraftrating = (!@$request->link_minecraftrating) ? "0" : @$request->link_minecraftrating;
            $general->save();
        }

        session()->flash('success', 'Настройки рейтинга успешно сохранены');
        return back();
    }
    #######################################################################################################################################
    public function dashboard() {
        $data['users'] = User::count('id');
        $data['onlines'] = Servers::sum('online');
        //$data['payments'] = GatewayPaylogs::all();
        $data['payments'] = GatewayPaylogs::count('id');
        $data['users_payment'] = GatewayPaylogs::all();
        return view('admin.dashboard', $data);
    }
    #######################################################################################################################################
    public function gatewaysList() {
        $unitpay = new GatewayUnitpay();
        $freekassa = new GatewayFreekassa();
        $gateways_list = array(
            1 => $unitpay->gateway(),
            2 => $freekassa->gateway()
        );
        return view('admin.gatewaysList', compact('gateways_list'));
    }
    public function gatewaysListSave(Request $request) {
        $gateway_id = @$request->id;
        if(@$gateway_id) {
            switch(@$gateway_id) {
                case 1:
                    $gate = new GatewayUnitpay;
                    $gate = @$gate->gateway();
                break;
                case 2:
                    $gate = new GatewayFreekassa;
                    $gate = @$gate->gateway();
                break;
            }
            $status = (@$request->status == 1) ? 1 : 0;
            $update = false;
            if(@$gateway_id == 1) {
                $excp = $request->except(
                    '_token',
                    'id'
                );
                $update = GatewayUnitpay::where('id', '=', 1)->update(@$excp + ['status' => $status]);
            }
            if(@$gateway_id == 2) {
                $excp = $request->except(
                    '_token',
                    'id'
                );
                $update = GatewayFreekassa::where('id', '=', 1)->update(@$excp + ['status' => $status]);
            }
            if(@$update) {
                $data = array(
                    'type' => 'success',
                    'message' => 'Шлюз '.@$gate->name.' успешно обновлён'
                );
                return response()->json($data);
            } else {
                $data = array(
                    'type' => 'warning',
                    'message' => 'Произошла ошибка в сохранении шлюза # '.@$gateway_id
                );
                return response()->json($data);
            }
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Произошла ошибка в поиске шлюза, обновите страницу'
            );
            return response()->json($data);
        }
    }
    #######################################################################################################################################
    public function serversList(Request $request) {
        $general = $this->general;
        $user = User::where('id', '=', @Auth::user()->id)->first();
        $servers = Servers::orderBy('id', 'DESC')->simplePaginate(50);
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.serversList', compact('general', 'user', 'servers', 'categories'));
    }
    public function serversListAdds(Request $request) {
        $status = (@$request->status == 1) ? 1 : 0;
        if(@!$request->name) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите название сервера'
            );
            return response()->json($data);
        }
        if(@!$request->ip) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите название IP сервера'
            );
            return response()->json($data);
        }
        if(@!$request->port) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите название PORT сервера'
            );
            return response()->json($data);
        }
        $excp = $request->except(
            '_token'
        );
        $adds = Servers::create(@$excp + ['status' => $status]);
        if(@$adds) {
            $data = array(
                'type' => 'success',
                'message' => 'Сервер '.@$request->name.' успешно добавлен'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Сервер не был добавлен, проверьте данные'
            );
            return response()->json($data);
        }
    }
    public function serversListSave(Request $request) {
        $id = @$request->id;
        // $status = (@$request->status == 1) ? 1 : 0;
        $status = 1;
        $excp = $request->except(
            '_token'
        );
        $adds = Servers::where('id', '=', @$id)->update(@$excp + ['status' => $status]);
        if(@$adds) {
            $data = array(
                'type' => 'success',
                'message' => 'Сервер '.@$request->name.' успешно сохранён'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Сервер не был сохранён, проверьте данные'
            );
            return response()->json($data);
        }
    }
    public function serversListDels(Request $request) {
        $id = @$request->id;
        $server = Servers::where('id', '=', @$id)->first();
        $server_delete = @Servers::where('id', '=', @$id)->delete();
        $items_delete = @Items::where('server_id', '=', @$server->id)->delete();
        $categorys_delete = @Category::where('server_id', '=', @$server->id)->delete();
        if(@$server_delete) {
            $data = array(
                'type' => 'success',
                'message' => 'Сервер '.@$server->name.', категории и предметы успешно удалены'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Сервер #'.@$id.' уже удалён или не существует'
            );
            return response()->json($data);
        }
    }
    #######################################################################################################################################
    public function categorysList(Request $request) {
        $general = $this->general;
        $user = User::where('id', '=', @Auth::user()->id)->first();
        $categorys = Category::orderBy('id', 'DESC')->simplePaginate(300);
        return view('admin.categorysList', compact('general', 'user', 'categorys'));
    }
    public function categorysListAdds(Request $request) {
        $status = (@$request->status == 1) ? 1 : 0;
        $server_id = (!@$request->server_id) ? 0 : @$request->server_id;
        $categorys_check = Category::where([
            ['name', '=', @$request->name],
            ['server_id', '=', @$server_id]
        ])->first();
        if(@$categorys_check->id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Категория с таким названием уже существует'
            );
            return response()->json($data);
        }
        if(@!$request->name) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите название категории'
            );
            return response()->json($data);
        }
        $excp = $request->except(
            '_token'
        );
        $adds = Category::create(@$excp + ['status' => $status]);
        if(@$adds) {
            $data = array(
                'type' => 'success',
                'message' => 'Категория '.@$request->name.' успешно добавлена'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Категория не была добавлена, проверьте данные'
            );
            return response()->json($data);
        }
    }
    public function categorysListSave(Request $request) {
        $id = @$request->id;
        $status = (@$request->status == 1) ? 1 : 0;
        $server_id = (!@$request->server_id) ? 0 : @$request->server_id;
        $categorys_check = Category::where([
            ['name', '=', @$request->name],
            ['server_id', '=', @$server_id]
        ])->first();
        if(@$categorys_check->id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Категория с таким названием уже существует'
            );
            return response()->json($data);
        }
        $excp = $request->except(
            '_token'
        );
        $adds = Category::where('id', '=', @$id)->update(@$excp + ['status' => $status]);
        if(@$adds) {
            $data = array(
                'type' => 'success',
                'message' => 'Категория '.@$request->name.' успешно сохранена'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Категория не была сохранена, проверьте данные'
            );
            return response()->json($data);
        }
    }
    public function categorysListDels(Request $request) {
        $id = @$request->id;
        $category = Category::where('id', '=', @$id)->first();
        $items_delete = @Items::where([
            ['server_id', '=', @$category->server_id],
            ['category_id', '=', @$category->id]
        ])->delete();
        $category_delete = Category::where('id', '=', @$id)->delete();
        if(@$category_delete) {
            $data = array(
                'type' => 'success',
                'message' => 'Категория '.@$category->name.', и предметы успешно удалены'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Категория #'.@$id.' уже удалена или не существует'
            );
            return response()->json($data);
        }
    }
    #######################################################################################################################################
    public function itemsList(Request $request) {
        $general = $this->general;
        $user = User::where('id', '=', @Auth::user()->id)->first();
        $items = Items::orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.itemsList', compact('general', 'user', 'items', 'categories'));
    }
    public function itemsListLoad(Request $request) {
        $general = $this->general;
        $items_list_server_id = @$request->items_list_server_id;
        $items_list_category_id = @$request->items_list_category_id;
        if(@$items_list_server_id && @$items_list_category_id) {
            $items = Items::where([
                ['server_id', '=', @$items_list_server_id],
                ['category_id', '=', @$items_list_category_id]
            ])->orderBy('id', 'DESC')->get();
            $categorys = Category::orderBy('id', 'DESC')->get();
            return view('admin.itemsList-list', compact('general', 'items', 'categorys'));
        } else {
            $categories = Category::where([
                ['status', '=', 1],
                ['server_id', '=', @$items_list_server_id]
            ])->orderBy('id', 'DESC')->get();
            return $categories;
        }
    }
    public function itemsListAdds(Request $request) {
        $status = (@$request->status == 1) ? 1 : 0;
        $items_check = Items::where([
            ['item_id', '=', @$request->item_id],
            ['server_id', '=', @$request->server_id],
            ['category_id', '=', @$request->category_id]
        ])->first();
        if(@$items_check->id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Предмет с таким ID уже существует'
            );
            return response()->json($data);
        }
        if(@!$request->image) {
            $data = array(
                'type' => 'warning',
                'message' => 'Выберите картинку предмета'
            );
            return response()->json($data);
        }
        if(@!$request->name) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите название предмета'
            );
            return response()->json($data);
        }
        if(@!$request->count) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите количество предмета'
            );
            return response()->json($data);
        }
        if(@!$request->server_id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Сервер не выбран, обновите страницу'
            );
            return response()->json($data);
        }
        if(@!$request->category_id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Категория не выбрана, обновите страницу'
            );
            return response()->json($data);
        }
        if(@!$request->item_id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите правильный ID предмета'
            );
            return response()->json($data);
        }
        if(@!$request->price) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите стоимость за кол-во предмета'
            );
            return response()->json($data);
        }
        $image_hash = "";
        if(@$request->hasFile('image')) {
            if(in_array(@$request->image->getClientOriginalExtension(), array('png', 'jpg', 'jpeg', 'gif'))) {
                $image_hash = md5($request->name.":".time()).".".@$request->image->getClientOriginalExtension();
                $is_upload = @Image::make(@$request->file('image')->getRealPath())->save("assets/minecraft/items/".$image_hash);
                if(!@$is_upload) {
                    $data = array(
                        'type' => 'warning',
                        'message' => 'Ошибка загрузки картинки, обновите страницу'
                    );
                    return response()->json($data);
                }
            } else {
                $data = array(
                    'type' => 'warning',
                    'message' => 'Допустимый формат картинки: PNG, JPG, JPEG, GIF'
                );
                return response()->json($data);
            }
        }
        $excp = $request->except(
            'image',
            '_token',
            'server_id_x',
            'category_id_x'
        );
        $adds = Items::create(@$excp + [
            'status' => $status,
            'image' => @$image_hash
        ]);
        if(@$adds) {
            $data = array(
                'type' => 'success',
                'message' => 'Предмет '.@$request->name.' успешно добавлен'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Предмет не был добавлен, проверьте данные'
            );
            return response()->json($data);
        }
    }
    public function itemsListSave(Request $request) {
        $id = @$request->id;
        $status = (@$request->status == 1) ? 1 : 0;
        $items_check = Items::where('id', '=', @$id)->first();
        if(@!$items_check->id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Не передан параметр ID, обновите страницу'
            );
            return response()->json($data);
        }
        if(@!$request->name) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите название предмета'
            );
            return response()->json($data);
        }
        if(@!$request->count) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите количество предмета'
            );
            return response()->json($data);
        }
        if(@!$request->server_id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Сервер не выбран, проверьте данные'
            );
            return response()->json($data);
        }
        if(@!$request->category_id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Категория не выбрана, проверьте данные'
            );
            return response()->json($data);
        }
        if(@!$request->item_id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите правильный ID предмета'
            );
            return response()->json($data);
        }
        if(@!$request->price) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите стоимость за кол-во предмета'
            );
            return response()->json($data);
        }
        $image_hash = @$items_check->image;
        if(@$request->hasFile('image')) {
            if(in_array(@$request->image->getClientOriginalExtension(), array('png', 'jpg', 'jpeg', 'gif'))) {
                $image_hash = md5($request->name.":".time()).".".@$request->image->getClientOriginalExtension();
                $is_upload = @Image::make(@$request->file('image')->getRealPath())->save("assets/minecraft/items/".$image_hash);
                if(!@$is_upload) {
                    @unlink($_SERVER['DOCUMENT_ROOT']."/assets/minecraft/items/".@$items_check->image);
                    $data = array(
                        'type' => 'warning',
                        'message' => 'Ошибка загрузки картинки, обновите страницу'
                    );
                    return response()->json($data);
                }
            } else {
                $data = array(
                    'type' => 'warning',
                    'message' => 'Допустимый формат картинки: PNG, JPG, JPEG, GIF'
                );
                return response()->json($data);
            }
        }
        $excp = $request->except(
            '_token',
            'server_id_x',
            'category_id_x'
        );
        $adds = Items::where('id', '=', @$id)->update(@$excp + ['status' => $status]);
        if(@$adds) {
            $data = array(
                'type' => 'success',
                'message' => 'Предмет '.@$items_check->name.' успешно сохранён'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Предмет не был сохранён, проверьте данные'
            );
            return response()->json($data);
        }
    }
    public function itemsListDels(Request $request) {
        $id = @$request->id;
        $item = Items::where('id', '=', @$id)->first();
        $delete = Items::where('id', '=', @$id)->delete();
        if(@$delete) {
            @unlink($_SERVER['DOCUMENT_ROOT']."/assets/minecraft/items/".@$item->image);
            $data = array(
                'type' => 'success',
                'message' => 'Предмет #'.@$item->name.' успешно удален'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Предмет #'.@$id.' уже удален или не существует'
            );
            return response()->json($data);
        }
    }
    #######################################################################################################################################
    public function privilegesList(Request $request) {
        $general = $this->general;
        $user = User::where('id', '=', @Auth::user()->id)->first();
        return view('admin.privilegesList', compact('general', 'user'));
    }
    public function privilegesListLoad(Request $request) {
        $general = $this->general;
        $privileges_list_server_id = @$request->privileges_list_server_id;
        if(@$privileges_list_server_id) {
            $privileges = Privileges::where('server_id', '=', @$privileges_list_server_id)->orderBy('id', 'DESC')->get();
            return view('admin.privilegesList-list', compact('general', 'privileges'));
        }
    }
    public function privilegesListAdds(Request $request) {
        $general = $this->general;
        $status = (@$request->status == 1) ? 1 : 0;
        $privileges_check = Privileges::where([
            ['name', '=', @$request->name],
            ['server_id', '=', @$request->server_id]
        ])->first();
        if(@$privileges_check->id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Привилегия с таким названием уже существует'
            );
            return response()->json($data);
        }
        if(@!$request->image) {
            $data = array(
                'type' => 'warning',
                'message' => 'Выберите картинку привилегии'
            );
            return response()->json($data);
        }
        if(@!$request->name) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите название привилегии'
            );
            return response()->json($data);
        }
        if(@!$request->display_name) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите отображаемое название привилегии'
            );
            return response()->json($data);
        }
        if(@!$request->server_id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Сервер не выбран, обновите страницу'
            );
            return response()->json($data);
        }
        // Значение -1 используется для обработки привилегий, которые выдаются "навсегда"
        if(@$request->term_days < 1 && @$request->term_days != -1) {
            $data = array(
                'type' => 'warning',
                'message' => 'Минимальное действие привилегии 1 день'
            );
            return response()->json($data);
        }
        if(@!$request->price) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите стоимость привилегии'
            );
            return response()->json($data);
        }
        if(@!in_array($request->prefix, array('0', '1'))) {
            $data = array(
                'type' => 'warning',
                'message' => 'Выберите параметр установки префикса'
            );
            return response()->json($data);
        }
        if(@!in_array($request->skin_hd, array('0', '1'))) {
            $data = array(
                'type' => 'warning',
                'message' => 'Выберите параметр установки HD скинов'
            );
            return response()->json($data);
        }
        if(@!in_array($request->cloak, array('0', '1'))) {
            $data = array(
                'type' => 'warning',
                'message' => 'Выберите параметр установки плащей'
            );
            return response()->json($data);
        }
        if(@!in_array($request->cloak_hd, array('0', '1'))) {
            $data = array(
                'type' => 'warning',
                'message' => 'Выберите параметр установки HD плащей'
            );
            return response()->json($data);
        }
        $image_hash = "";
        if(@$request->hasFile('image')) {
            if(in_array(@$request->image->getClientOriginalExtension(), array('png', 'jpg', 'jpeg', 'gif'))) {
                $image_hash = md5($request->name.":".time()).".".@$request->image->getClientOriginalExtension();
                $is_upload = @Image::make(@$request->file('image')->getRealPath())->save("assets/minecraft/privileges/".$image_hash);
                if(!@$is_upload) {
                    $data = array(
                        'type' => 'warning',
                        'message' => 'Ошибка загрузки картинки, обновите страницу'
                    );
                    return response()->json($data);
                }
            } else {
                $data = array(
                    'type' => 'warning',
                    'message' => 'Допустимый формат картинки: PNG, JPG, JPEG, GIF'
                );
                return response()->json($data);
            }
        }
        $excp = $request->except(
            'image',
            '_token',
            'status',
            'server_id_x'
        );
        $adds = Privileges::create(@$excp + [
            'status' => $status,
            'image' => @$image_hash
        ]);
        if(@$adds) {
            $data = array(
                'type' => 'success',
                'message' => 'Привилегия '.@$request->name.' успешно добавлена'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Привилегия не была добавлена, проверьте данные'
            );
            return response()->json($data);
        }
    }
    public function privilegesListSave(Request $request) {
        $id = @$request->id;
        $status = (@$request->status == 1) ? 1 : 0;
        $privileges_check = Privileges::where('id', '=', @$id)->first();
        if(@!$privileges_check->id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Не передан параметр ID, обновите страницу'
            );
            return response()->json($data);
        }
        if(@!$request->name) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите название привилегии'
            );
            return response()->json($data);
        }
        if(@!$request->server_id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Сервер не выбран, обновите страницу'
            );
            return response()->json($data);
        }
        // Значение -1 используется для обработки привилегий, которые выдаются "навсегда"
        if(@$request->term_days < 1 && @$request->term_days != -1) {
            $data = array(
                'type' => 'warning',
                'message' => 'Минимальное действие привилегии 1 день'
            );
            return response()->json($data);
        }
        if(@!$request->price) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите стоимость привилегии'
            );
            return response()->json($data);
        }
        if(@!in_array($request->prefix, array('0', '1'))) {
            $data = array(
                'type' => 'warning',
                'message' => 'Выберите параметр установки префикса'
            );
            return response()->json($data);
        }
        if(@!in_array($request->skin_hd, array('0', '1'))) {
            $data = array(
                'type' => 'warning',
                'message' => 'Выберите параметр установки HD скинов'
            );
            return response()->json($data);
        }
        if(@!in_array($request->cloak, array('0', '1'))) {
            $data = array(
                'type' => 'warning',
                'message' => 'Выберите параметр установки плащей'
            );
            return response()->json($data);
        }
        if(@!in_array($request->cloak_hd, array('0', '1'))) {
            $data = array(
                'type' => 'warning',
                'message' => 'Выберите параметр установки HD плащей'
            );
            return response()->json($data);
        }
        $image_hash = @$privileges_check->image;
        if(@$request->hasFile('image')) {
            if(in_array(@$request->image->getClientOriginalExtension(), array('png', 'jpg', 'jpeg', 'gif'))) {
                $image_hash = md5($request->name.":".time()).".".@$request->image->getClientOriginalExtension();
                $is_upload = @Image::make(@$request->file('image')->getRealPath())->save("assets/minecraft/privileges/".$image_hash);
                if(!@$is_upload) {
                    @unlink($_SERVER['DOCUMENT_ROOT']."/assets/minecraft/privileges/".@$privileges_check->image);
                    $data = array(
                        'type' => 'warning',
                        'message' => 'Ошибка загрузки картинки, обновите страницу'
                    );
                    return response()->json($data);
                }
            } else {
                $data = array(
                    'type' => 'warning',
                    'message' => 'Допустимый формат картинки: PNG, JPG, JPEG, GIF'
                );
                return response()->json($data);
            }
        }
        $excp = $request->except(
            'image',
            '_token',
            'status',
            'server_id_x'
        );
        $adds = Privileges::where('id', '=', @$id)->update(@$excp + [
            'status' => $status,
            'image' => @$image_hash
        ]);
        if(@$adds) {
            $data = array(
                'type' => 'success',
                'message' => 'Привилегия '.@$request->name.' успешно сохранена'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Привилегия не была сохранена, проверьте данные'
            );
            return response()->json($data);
        }
    }
    public function privilegesListDels(Request $request) {
        $id = @$request->id;
        $privilege = Privileges::where('id', '=', @$id)->first();
        $delete = Privileges::where('id', '=', @$id)->delete();
        if(@$delete) {
            @unlink($_SERVER['DOCUMENT_ROOT']."/assets/minecraft/privileges/".@$privilege->image);
            $data = array(
                'type' => 'success',
                'message' => 'Привилегия '.@$privilege->name.' успешно удалена'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Привилегия #'.@$id.' уже удалена или не существует'
            );
            return response()->json($data);
        }
    }
    #######################################################################################################################################
    public function kitsList(Request $request) {
        $general = $this->general;
        $user = User::where('id', '=', @Auth::user()->id)->first();
        return view('admin.kitsList', compact('general', 'user'));
    }
    public function kitsListLoad(Request $request) {
        $general = $this->general;
        $kits_list_server_id = @$request->kits_list_server_id;
        if(@$kits_list_server_id) {
            $kits = Kits::where('server_id', '=', @$kits_list_server_id)->orderBy('id', 'DESC')->get();
            return view('admin.kitsList-list', compact('general', 'kits'));
        }
    }
    public function kitsListAdds(Request $request) {
        $status = (@$request->status == 1) ? 1 : 0;
        $kits_check = Kits::where([
            ['name', '=', @$request->name],
            ['server_id', '=', @$request->server_id]
        ])->first();
        if(@$kits_check->id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Набор с таким названием уже существует'
            );
            return response()->json($data);
        }
        if(@!$request->image) {
            $data = array(
                'type' => 'warning',
                'message' => 'Выберите картинку набора'
            );
            return response()->json($data);
        }
        if(@!$request->name) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите название набора'
            );
            return response()->json($data);
        }
        if(@!$request->server_id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Сервер не выбран, обновите страницу'
            );
            return response()->json($data);
        }
        if(@$request->count < 1) {
            $data = array(
                'type' => 'warning',
                'message' => 'Минимальное количество набора 1 шт'
            );
            return response()->json($data);
        }
        if(@!$request->price) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите стоимость набора'
            );
            return response()->json($data);
        }
        $image_hash = "";
        if(@$request->hasFile('image')) {
            if(in_array(@$request->image->getClientOriginalExtension(), array('png', 'jpg', 'jpeg', 'gif'))) {
                $image_hash = md5($request->name.":".time()).".".@$request->image->getClientOriginalExtension();
                $is_upload = @Image::make(@$request->file('image')->getRealPath())->save("assets/minecraft/kits/".$image_hash);
                if(!@$is_upload) {
                    $data = array(
                        'type' => 'warning',
                        'message' => 'Ошибка загрузки картинки'
                    );
                    return response()->json($data);
                }
            } else {
                $data = array(
                    'type' => 'warning',
                    'message' => 'Допустимый формат картинки: PNG, JPG, JPEG, GIF'
                );
                return response()->json($data);
            }
        }
        $kit = new Kits;
        $kit->name = $request->name;
        $kit->description = 'Набор ресурсов';
        $kit->server_id = $request->server_id;
        $kit->server_cmd = $request->server_cmd;
        $kit->count = $request->count;
        $kit->price = $request->price;
        $kit->image = $image_hash;
        $kit->status = 1;

        $kit->save();

        if(@$kit) {
            $data = array(
                'type' => 'success',
                'message' => 'Набор '.@$request->name.' успешно добавлен'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Набор не был добавлен, проверьте данные'
            );
            return response()->json($data);
        }
    }
    public function kitsListSave(Request $request) {
        $id = @$request->id;
        $status = (@$request->status == 1) ? 1 : 0;
        $kits_check = Kits::where('id', '=', @$id)->first();
        if(@!$kits_check->id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Не передан параметр ID, обновите страницу'
            );
            return response()->json($data);
        }
        if(@!$request->name) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите название набора'
            );
            return response()->json($data);
        }
        if(@!$request->server_id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Сервер не выбран, обновите страницу'
            );
            return response()->json($data);
        }
        if(@$request->count < 1) {
            $data = array(
                'type' => 'warning',
                'message' => 'Минимальное количество набора 1 шт'
            );
            return response()->json($data);
        }
        if(@!$request->price) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите стоимость набора'
            );
            return response()->json($data);
        }
        $image_hash = @$kits_check->image;
        if(@$request->hasFile('image')) {
            if(in_array(@$request->image->getClientOriginalExtension(), array('png', 'jpg', 'jpeg', 'gif'))) {
                $image_hash = md5($request->name.":".time()).".".@$request->image->getClientOriginalExtension();
                $is_upload = @Image::make(@$request->file('image')->getRealPath())->save("assets/minecraft/kits/".$image_hash);
                if(!@$is_upload) {
                    @unlink($_SERVER['DOCUMENT_ROOT']."/assets/minecraft/kits/".@$kits_check->image);
                    $data = array(
                        'type' => 'warning',
                        'message' => 'Ошибка загрузки картинки, обновите страницу'
                    );
                    return response()->json($data);
                }
            } else {
                $data = array(
                    'type' => 'warning',
                    'message' => 'Допустимый формат картинки: PNG, JPG, JPEG, GIF'
                );
                return response()->json($data);
            }
        }
        $excp = $request->except(
            'image',
            '_token',
            'status',
            'server_id_x'
        );
        $adds = Kits::where('id', '=', @$id)->update(@$excp + [
            'status' => $status,
            'image' => @$image_hash
        ]);
        if(@$adds) {
            $data = array(
                'type' => 'success',
                'message' => 'Набор '.@$request->name.' успешно сохранен'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Набор не был сохранен, проверьте данные'
            );
            return response()->json($data);
        }
    }
    public function kitsListDels(Request $request) {
        $id = @$request->id;
        $kit = Kits::where('id', '=', @$id)->first();
        $delete = Kits::where('id', '=', @$id)->delete();
        if(@$delete) {
            @unlink($_SERVER['DOCUMENT_ROOT']."/assets/minecraft/kits/".@$kit->image);
            $data = array(
                'type' => 'success',
                'message' => 'Набор '.@$kit->name.' успешно удален'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Набор #'.@$id.' уже удален или не существует'
            );
            return response()->json($data);
        }
    }
    #######################################################################################################################################
    public function revenueStatic(Request $request) {
        $action = $request->action;
        if(@$action == "info") {
            $search = $request->search;
            $status = $request->status;
            if(@$search) {
                $user = User::where('username', '=', $search)->first();

                if(@$status) {
                    $data['bills_list'] = GatewayPaylogs::where([
                        ['user_id', '=', @$user->id],
                        ['status', '=', $status],
                    ])->orderBy('id', 'DESC')->simplePaginate(10);
                    $data['bills_count_today'] =  GatewayPaylogs::where([
                        ['user_id', '=', @$user->id],
                        ['status', '=', $status]
                    ])->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->count('id');
                    $data['bills_count_month'] =  GatewayPaylogs::where([
                        ['user_id', '=', @$user->id],
                        ['status', '=', $status]
                    ])->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count('id');
                    $data['bills_count_years'] =  GatewayPaylogs::where([
                        ['user_id', '=', @$user->id],
                        ['status', '=', $status]
                    ])->whereYear('created_at', '=', date('Y'))->count('id');
                } else {
                    $data['bills_list'] = GatewayPaylogs::where('user_id', '=', @$user->id)->orderBy('id', 'DESC')->simplePaginate(10);
                    $data['bills_count_today'] =  GatewayPaylogs::where('user_id', '=', @$user->id)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->count('id');
                    $data['bills_count_month'] =  GatewayPaylogs::where('user_id', '=', @$user->id)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count('id');
                    $data['bills_count_years'] =  GatewayPaylogs::where('user_id', '=', @$user->id)->whereYear('created_at', '=', date('Y'))->count('id');
                }

                $data['bills_total'] = GatewayPaylogs::where('user_id', '=', @$user->id)->count('id');
                $data['bills_payed'] = GatewayPaylogs::where([
                    ['user_id', '=', @$user->id],
                    ['status', '=', 1],
                ])->count('id');
                $data['bills_notpayed'] = GatewayPaylogs::where([
                    ['user_id', '=', @$user->id],
                    ['status', '=', 0]
                ])->count('id');
                $data['bills_payed_sum'] = GatewayPaylogs::where([
                    ['user_id', '=', @$user->id],
                    ['status', '=', 1],
                ])->sum('money');
                $data['bills_notpayed_sum'] = GatewayPaylogs::where([
                    ['user_id', '=', @$user->id],
                    ['status', '=', 0]
                ])->sum('money');
            } else {
                if(@$status == '1' || @$status == '0') {
                    $data['bills_list'] = GatewayPaylogs::where('status', '=', $status)->orderBy('id', 'DESC')->simplePaginate(10);
                    $data['bills_count_today'] =  GatewayPaylogs::where('status', '=', $status)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->count('id');
                    $data['bills_count_month'] =  GatewayPaylogs::where('status', '=', $status)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count('id');
                    $data['bills_count_years'] =  GatewayPaylogs::where('status', '=', $status)->whereYear('created_at', '=', date('Y'))->count('id');
                } else {
                    $data['bills_list'] = GatewayPaylogs::orderBy('id', 'DESC')->simplePaginate(10);
                    $data['bills_count_today'] =  GatewayPaylogs::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->count('id');
                    $data['bills_count_month'] =  GatewayPaylogs::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count('id');
                    $data['bills_count_years'] =  GatewayPaylogs::whereYear('created_at', '=', date('Y'))->count('id');
                }

                $data['bills_total'] = GatewayPaylogs::count('id');
                $data['bills_payed'] = GatewayPaylogs::where('status', '=', 1)->count('id');
                $data['bills_notpayed'] = GatewayPaylogs::where('status', '=', 0)->count('id');
                $data['bills_payed_sum'] = GatewayPaylogs::where('status', '=', 1)->sum('money');
                $data['bills_notpayed_sum'] = GatewayPaylogs::where('status', '=', 0)->sum('money');
            }
            $data['bills_сonversion'] = @round(@$data['bills_payed'] / @$data['bills_total'] * 100, 2);
            if(@$data['bills_total'] == 0) {
                $data['bills_сonversion'] = "0";
            }
            if($data['bills_сonversion'] > 100) {
                $data['bills_сonversion'] = "100";
            }
            $data['search'] = @$search;
            return view('admin.revenueStatic-info', $data);
        } else {
            return view('admin.revenueStatic', compact('request'));
        }
    }

    public function usersList(Request $request) {
        $action = $request->action;
        if(@$action == "info") {
            $search = @$request->search;
            $status = @$request->status;
            $status_exp = explode('_', $status);
            if(@$search) {
                $user = User::where('username', '=', $search)->first();

                if(@$status) {
                    if(@$status_exp[0] == "access") {
                        $data['users_list'] = User::where([
                            ['id', '=', @$user->id],
                            ['access', '=', $status_exp[1]]
                        ])->orderBy('id', 'DESC')->simplePaginate(10);
                        $data['users_count_today'] =  User::where([
                            ['id', '=', @$user->id],
                            ['access', '=', $status_exp[1]]
                        ])->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->count('id');
                        $data['users_count_month'] =  User::where([
                            ['id', '=', @$user->id],
                            ['access', '=', $status_exp[1]]
                        ])->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count('id');
                        $data['users_count_years'] =  User::where([
                            ['id', '=', @$user->id],
                            ['access', '=', $status_exp[1]]
                        ])->whereYear('created_at', '=', date('Y'))->count('id');
                    } else {
                        $data['users_list'] = User::where([
                            ['id', '=', @$user->id],
                            ['status', '=', $status]
                        ])->orderBy('id', 'DESC')->simplePaginate(10);
                        $data['users_count_today'] =  User::where([
                            ['id', '=', @$user->id],
                            ['status', '=', $status]
                        ])->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->count('id');
                        $data['users_count_month'] =  User::where([
                            ['id', '=', @$user->id],
                            ['status', '=', $status]
                        ])->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count('id');
                        $data['users_count_years'] =  User::where([
                            ['id', '=', @$user->id],
                            ['status', '=', $status]
                        ])->whereYear('created_at', '=', date('Y'))->count('id');
                    }
                } else {
                    $data['users_list'] = User::where('id', '=', @$user->id)->orderBy('id', 'DESC')->simplePaginate(10);
                    $data['users_count_today'] =  User::where('id', '=', @$user->id)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->count('id');
                    $data['users_count_month'] =  User::where('id', '=', @$user->id)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count('id');
                    $data['users_count_years'] =  User::where('id', '=', @$user->id)->whereYear('created_at', '=', date('Y'))->count('id');
                }

                $data['users_total'] = User::where('id', '=', @$user->id)->count('id');
            } else {
                if(@$status || @$status == '0') {
                    if(@$status_exp[0] == "access") {
                        $data['users_list'] = User::where('access', '=', $status_exp[1])->orderBy('id', 'DESC')->simplePaginate(10);
                        $data['users_count_today'] =  User::where('access', '=', $status_exp[1])->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->count('id');
                        $data['users_count_month'] =  User::where('access', '=', $status_exp[1])->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count('id');
                        $data['users_count_years'] =  User::where('access', '=', $status_exp[1])->whereYear('created_at', '=', date('Y'))->count('id');
                    } else {
                        $data['users_list'] = User::where('status', '=', $status)->orderBy('id', 'DESC')->simplePaginate(10);
                        $data['users_count_today'] =  User::where('status', '=', $status)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->count('id');
                        $data['users_count_month'] =  User::where('status', '=', $status)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count('id');
                        $data['users_count_years'] =  User::where('status', '=', $status)->whereYear('created_at', '=', date('Y'))->count('id');
                    }
                } else {
                    $data['users_list'] = User::orderBy('id', 'DESC')->simplePaginate(10);
                    $data['users_count_today'] =  User::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->count('id');
                    $data['users_count_month'] =  User::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count('id');
                    $data['users_count_years'] =  User::whereYear('created_at', '=', date('Y'))->count('id');
                }

                $data['users_total'] = User::count('id');
            }
            $data['search'] = @$search;
            return view('admin.users.usersList-info', $data);
        } else {
            return view('admin.users.usersList', compact('request'));
        }
    }

    public function usersListUser($id) {
        $data['user'] = User::findOrFail($id);
        $data['username'] = $data['user']->username;
        $data['hash'] = md5(mt_rand(10000000, 99999999));

        $data['spent_today'] = 0;
        $spent_today = GatewayPaylogs::where([
            ['status', '=', 1],
            ['user_id', $data['user']->id]
        ])->whereDay('created_at', '=', date('d'))->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->sum('money');
        $data['spent_today'] = number_format(@$spent_today, 2, '.', '');

        $data['spent_month'] = 0;
        $spent_month = GatewayPaylogs::where([
            ['status', '=', 1],
            ['user_id', $data['user']->id]
        ])->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->sum('money');
        $data['spent_month'] = number_format(@$spent_month, 2, '.', '');

        $data['spent_years'] = 0;
        $spent_years = GatewayPaylogs::where([
            ['status', '=', 1],
            ['user_id', $data['user']->id]
        ])->whereYear('created_at', '=', date('Y'))->sum('money');
        $data['spent_years'] = number_format(@$spent_years, 2, '.', '');

        $data['spent_fulls'] = 0;
        $spent_fulls = GatewayPaylogs::where([
            ['status', '=', 1],
            ['user_id', $data['user']->id]
        ])->sum('money');
        $data['spent_fulls'] = number_format(@$spent_fulls, 2, '.', '');

        $all_score = GatewayPaylogs::where('user_id', $data['user']->id)->count('id');
        $paid_score = GatewayPaylogs::where([
            ['status', '=', 1],
            ['user_id', $data['user']->id]
        ])->count('id');
        $data['spent_conversion'] = @round(@$paid_score / @$all_score * 100, 2);
        if(@$all_score == 0) {
            $data['spent_conversion'] = "0";
        }
        if($data['spent_conversion'] > 100) {
            $data['spent_conversion'] = "100";
        }

        $data['file_skin'] = asset('assets/minecraft/skins')."/".$data['username'].".png?u=".$data['hash'];
        $data['file_cloak'] = asset('assets/minecraft/cloaks')."/".$data['username'].".png?u=".$data['hash'];
        if(!file_exists($_SERVER['DOCUMENT_ROOT']."/assets/minecraft/skins/".$data['username'].".png")) {
            $data['file_skin'] = asset('assets/minecraft/skins')."/default.png?u=".$data['hash'];
        }
        if(!file_exists($_SERVER['DOCUMENT_ROOT']."/assets/minecraft/cloaks/".$data['username'].".png")) {
            $data['file_cloak'] = asset('assets/minecraft/cloaks')."/default.png?u=".$data['hash'];
        }

        return view('admin.users.usersListUser', $data);
    }

    public function usersListUserView(Request $request, $id) {
        $user = User::where('id', '=', @$id)->first();
        $skin = @$request->skin;
        $cloak = @$request->cloak;
        if(@$skin) {
            @unlink($_SERVER['DOCUMENT_ROOT']."/assets/minecraft/skins/".@$user->username.".png");
            session()->flash('success', 'Скин пользователя успешно удалён');
            return back();
        }
        if(@$cloak) {
            @unlink($_SERVER['DOCUMENT_ROOT']."/assets/minecraft/cloaks/".@$user->username.".png");
            session()->flash('success', 'Плащ пользователя успешно удалён');
            return back();
        }
    }

    public function usersListUserUpdate(Request $request, $id) {
        $user = User::find($id);

        $this->validate($request,
            [
                'email' => 'required|string|max:255',
            ]
        );

        $user->remember_token = (!@$request->remember_token) ? str_random(60) : @$request->remember_token;
        $user->access = (!@$request->access) ? 0 : @$request->access;
        $balance = number_format(@$request->balance, 2, '.', '');
        if(@$balance) {
            $balance_plus = $user->balance_real - $balance;
            // $balance_plus = $user->balance - $balance_plus;
            $balance_minus = $user->balance_real - $balance;
            if($balance > $user->balance) {
                $user->balance_real = $balance;
                GatewayTransact::create([
                    'user_id' => $user->id,
                    'gateway' => Auth::guard('admin')->user()->username,
                    'amount' => abs($balance_plus),
                    'user_balance' => $user->balance_real,
                    'charge' => null,
                    'type' => '0',
                    'trx' => ToolsController::hasherstring(str_random(12))
                ]);
            } elseif($balance < $user->balance_real) {
                $user->balance_real = $balance;
                if($balance <= 0) {
                    GatewayTransact::create([
                        'user_id' => $user->id,
                        'gateway' => Auth::guard('admin')->user()->username,
                        'amount' => $balance_minus,
                        'user_balance' => $user->balance_real,
                        'charge' => null,
                        'type' => '4',
                        'trx' => ToolsController::hasherstring(str_random(12))
                    ]);
                } else {
                    GatewayTransact::create([
                        'user_id' => $user->id,
                        'gateway' => Auth::guard('admin')->user()->username,
                        'amount' => $balance_minus,
                        'user_balance' => $user->balance_real,
                        'charge' => null,
                        'type' => '4',
                        'trx' => ToolsController::hasherstring(str_random(12))
                    ]);
                }
            }
        }
        if(@$request->hasFile('skin')) {
            if(@$request->skin->getClientOriginalExtension() == 'png') {
                $skin_w = @Image::make(@$request->file('skin'))->width();
                $skin_h = @Image::make(@$request->file('skin'))->height();
                $skin_dims = array(
                    0 => array('64','64','128','256','512','1024'),
                    1 => array('32','64','64','128','256','512')
                );
                if(in_array($skin_w, $skin_dims[0]) && in_array($skin_h, $skin_dims[1])) {
                    @Image::make(@$request->file('skin')->getRealPath())->save("assets/minecraft/skins/".@$user->username.".png");
                }
            }
        }
        if(@$request->hasFile('cloak')) {
            if(@$request->cloak->getClientOriginalExtension() == 'png') {
                $cloak_w = @Image::make(@$request->file('cloak'))->width();
                $cloak_h = @Image::make(@$request->file('cloak'))->height();
                $cloak_dims = array(
                    0 => array('64','64','128','256','512'),
                    1 => array('32','64','64','128','256')
                );
                if(in_array($cloak_w, $cloak_dims[0]) && in_array($cloak_h, $cloak_dims[1])) {
                    @Image::make(@$request->file('cloak')->getRealPath())->save("assets/minecraft/cloaks/".@$user->username.".png");
                }
            }
        }

        $user->status = ($request->status == "1") ? 1 : 0;
        $user->email = (!@$request->email) ? 0 : @$request->email;
        $user->balance_real = (!@$request->balance_real) ? 0 : @$request->balance_real;
        $user->save();
        return back()->withSuccess('Профиль пользователя обновлен');
    }

    public function usersListAdds(Request $request) {
        // return @$request;
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'username' => 'required|string|alpha_dash|max:16|unique:users|regex:/(^([A-Za-z\-_][A-Za-z0-9\-_]+)(\d+)?$)/u',
            'api_key' => 'required|string|max:255',
        ],
        [
            'email.unique' => 'Данный e-mail уже используется в системе',
            'email.required' => 'Не введён e-mail пользователя',
            'password.required' => 'Не введён пароль пользователя',
            'password.min' => 'Минимальная длина пароля 6 символов',
            'password.confirmed' => 'Введённые пароли не совпадают',
            'username.required' => 'Не введён логин пользователя',
            'username.max' => 'Максимальная длинна логина 12 символов',
            'username.regex' => 'Логин должен состоять из латиницы и цифр',
            'username.unique' => 'Данный логин уже используется в системе',
            'api_key.required' => 'Не введён API ключ пользователя'
        ]);
        if(!@$request->balance) {
            $request->balance = 0;
        }
        $user = User::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'verification_time' => Carbon::now(),
            'verification_code' => strtoupper(str_random(32)),
            'email_verify' => 0,
            'api_key' => $request->api_key,
            'balance' => $request->balance
        ]);
        $services = Service::all();
        foreach($services as $service){
            $servicePrice = new ServicePrice();
            $servicePrice->category_id = $service->category_id;
            $servicePrice->service_id = $service->id;
            $servicePrice->user_id = $user->id;
            $servicePrice->price = 0;
            $servicePrice->save();
        }
        if(@$user->id) {
            return $user;
        } else {
            return "Error user create";
        }
    }

    public function usersListUserLogout(Request $request) {
        if(@$request->id) {
            $user = User::where('id', '=', @$request->id)->first();
            $user->logout = true;
            $user->save();
            $data = array(
                'type' => 'success',
                'message' => 'Пользователь '.@$user->username.' успешно деавторизован'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Не передан USER-ID, обновите страницу'
            );
            return response()->json($data);
        }
    }

    public function usersListNotify(Request $request, $id) {
        $user = User::where('id', '=', @$id)->first();
        return view('admin.users.usersListNotify', compact('request', 'user'));
    }

    public function usersListNotifyInfo(Request $request) {
        $user = User::where('id', '=', @$request->id)->first();
        $action = $request->action;
        if(@$action == "info") {
            $search = @$request->search;
            $status = @$request->status;
            if(@$search) {
                if(@$status || @$status == '0') {
                    $data['notify_list'] = UsersNotify::where([
                        ['status', '=', $status],
                        ['user_id', '=', @$user->id],
                        ['subject', 'like', '%'.$search.'%']
                    ])->orderBy('id', 'DESC')->simplePaginate(10);
                } else {
                    $data['notify_list'] = UsersNotify::where([
                        ['user_id', '=', @$user->id],
                        ['subject', 'like', '%'.$search.'%']
                    ])->orderBy('id', 'DESC')->simplePaginate(10);
                }
            } else {
                if(@$status || @$status == '0') {
                    $data['notify_list'] = UsersNotify::where([
                        ['status', '=', $status],
                        ['user_id', '=', @$user->id]
                    ])->orderBy('id', 'DESC')->simplePaginate(10);
                } else {
                    $data['notify_list'] = UsersNotify::where('user_id', '=', @$user->id)->orderBy('id', 'DESC')->simplePaginate(10);
                }
            }
            $data['search'] = @$search;
            return view('admin.users.usersListNotify-info', $data);
        }
    }

    public function usersListNotifySend(Request $request) {
        $user = User::where('id', '=', @$request->user_id)->first();
        if(!@$request->notify_type) {
            $data = array(
                'type' => 'warning',
                'message' => 'Выберите тип уведомления для отправки'
            );
            return response()->json($data);
        }
        if(!@$request->subject) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите название темы уведомления для отправки'
            );
            return response()->json($data);
        }
        if(!@$request->message) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите сообщение темы уведомления для отправки'
            );
            return response()->json($data);
        }
        if(@$request->notify_type == '1') {
            if(!@$request->type) {
                $data = array(
                    'type' => 'warning',
                    'message' => 'Выберите системный тип уведомления для отправки'
                );
                return response()->json($data);
            }
            if(@$request->timeout <= '10000') {
                $data = array(
                    'type' => 'warning',
                    'message' => 'Время показа уведомления не может быть меньше 10 секунд'
                );
                return response()->json($data);
            }
        }
        $create = UsersNotify::create([
            'user_id' => @$user->id,
            'subject' => @$request->subject,
            'message' => nl2br(@$request->message),
            'sender_id' => Auth::user()->id,
            'notify_type' => @$request->notify_type,
            'timeout' => @$request->timeout,
            'type' => (!@$request->type) ? 'info' : @$request->type,
            'status' => 1
        ]);
        if(@$create) {
            $data = array(
                'type' => 'success',
                'message' => 'Уведомление клиенту '.$user->username.' успешно отправлено'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Произошла ошибка при отправке уведомления'
            );
            return response()->json($data);
        }
    }

    public function transactionsStatic(Request $request) {
        $action = $request->action;
        if(@$action == "info") {
            $search = @$request->search;
            $status = @$request->status;
            if(@$search) {
                $user = User::where('username', '=', $search)->first();

                if(@$status || @$status == '0') {
                    $data['transactions_list'] = GatewayTransact::where([
                        ['user_id', '=', @$user->id],
                        ['type', '=', $status]
                    ])->orderBy('id', 'DESC')->simplePaginate(10);
                    $data['transactions_count_today'] =  GatewayTransact::where([
                        ['user_id', '=', @$user->id],
                        ['type', '=', $status]
                    ])->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->count('id');
                    $data['transactions_count_month'] =  GatewayTransact::where([
                        ['user_id', '=', @$user->id],
                        ['type', '=', $status]
                    ])->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count('id');
                    $data['transactions_count_years'] =  GatewayTransact::where([
                        ['user_id', '=', @$user->id],
                        ['type', '=', $status]
                    ])->whereYear('created_at', '=', date('Y'))->count('id');
                } else {
                    $data['transactions_list'] = GatewayTransact::where('user_id', '=', @$user->id)->orderBy('id', 'DESC')->simplePaginate(10);
                    $data['transactions_count_today'] =  GatewayTransact::where('user_id', '=', @$user->id)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->count('id');
                    $data['transactions_count_month'] =  GatewayTransact::where('user_id', '=', @$user->id)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count('id');
                    $data['transactions_count_years'] =  GatewayTransact::where('user_id', '=', @$user->id)->whereYear('created_at', '=', date('Y'))->count('id');
                }

                $data['transactions_total'] = GatewayTransact::where('user_id', '=', @$user->id)->count('id');
            } else {
                if(@$status || @$status == '0') {
                    $data['transactions_list'] = GatewayTransact::where('type', '=', $status)->orderBy('id', 'DESC')->simplePaginate(10);
                    $data['transactions_count_today'] =  GatewayTransact::where('type', '=', $status)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->count('id');
                    $data['transactions_count_month'] =  GatewayTransact::where('type', '=', $status)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count('id');
                    $data['transactions_count_years'] =  GatewayTransact::where('type', '=', $status)->whereYear('created_at', '=', date('Y'))->count('id');
                } else {
                    $data['transactions_list'] = GatewayTransact::orderBy('id', 'DESC')->simplePaginate(10);
                    $data['transactions_count_today'] =  GatewayTransact::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->count('id');
                    $data['transactions_count_month'] =  GatewayTransact::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count('id');
                    $data['transactions_count_years'] =  GatewayTransact::whereYear('created_at', '=', date('Y'))->count('id');
                }

                $data['transactions_total'] = GatewayTransact::count('id');
            }
            $data['search'] = @$search;
            return view('admin.transactionsStatic-info', $data);
        } else {
            return view('admin.transactionsStatic', compact('request'));
        }
    }

    public function authorizationsLogs(Request $request) {
        $action = $request->action;
        if(@$action == "info") {
            $search = @$request->search;
            $status = @$request->status;
            if(@$search) {
                $user = User::where('username', '=', $search)->first();

                if(@$status || @$status == '0') {
                    $data['authorizations_list'] = UserAuth::where([
                        ['user_id', '=', @$user->id],
                        ['type', '=', $status]
                    ])->orderBy('id', 'DESC')->simplePaginate(10);
                    $data['authorizations_count_today'] =  UserAuth::where([
                        ['user_id', '=', @$user->id],
                        ['type', '=', $status]
                    ])->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->count('id');
                    $data['authorizations_count_month'] =  UserAuth::where([
                        ['user_id', '=', @$user->id],
                        ['type', '=', $status]
                    ])->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count('id');
                    $data['authorizations_count_years'] =  UserAuth::where([
                        ['user_id', '=', @$user->id],
                        ['type', '=', $status]
                    ])->whereYear('created_at', '=', date('Y'))->count('id');
                } else {
                    $data['authorizations_list'] = UserAuth::where('user_id', '=', @$user->id)->orderBy('id', 'DESC')->simplePaginate(10);
                    $data['authorizations_count_today'] =  UserAuth::where('user_id', '=', @$user->id)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->count('id');
                    $data['authorizations_count_month'] =  UserAuth::where('user_id', '=', @$user->id)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count('id');
                    $data['authorizations_count_years'] =  UserAuth::where('user_id', '=', @$user->id)->whereYear('created_at', '=', date('Y'))->count('id');
                }

                $data['transactions_total'] = UserAuth::where('user_id', '=', @$user->id)->count('id');
            } else {
                if(@$status || @$status == '0') {
                    $data['authorizations_list'] = UserAuth::where('type', '=', $status)->orderBy('id', 'DESC')->simplePaginate(10);
                    $data['authorizations_count_today'] =  UserAuth::where('type', '=', $status)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->count('id');
                    $data['authorizations_count_month'] =  UserAuth::where('type', '=', $status)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count('id');
                    $data['authorizations_count_years'] =  UserAuth::where('type', '=', $status)->whereYear('created_at', '=', date('Y'))->count('id');
                } else {
                    $data['authorizations_list'] = UserAuth::orderBy('id', 'DESC')->simplePaginate(10);
                    $data['authorizations_count_today'] =  UserAuth::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->count('id');
                    $data['authorizations_count_month'] =  UserAuth::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count('id');
                    $data['authorizations_count_years'] =  UserAuth::whereYear('created_at', '=', date('Y'))->count('id');
                }

                $data['authorizations_total'] = UserAuth::count('id');
            }
            $data['search'] = @$search;
            return view('admin.authorizationsLogs-info', $data);
        } else {
            return view('admin.authorizationsLogs', compact('request'));
        }
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin')->with('success', 'Выход из админ-панели успешно совершен');
    }

    public function passwordChange(Request $request) {
        $user = Admin::findOrFail(Auth::guard('admin')->user()->id);
        $this->validate($request,[
            'cur_pass' => 'required',
            'new_pass' => 'required|min:5',
            'con_pass' => 'required',
        ],
            [
                'cur_pass.required' => 'Текущий пароль не должен быть пустым',
                'new_pass.required' => 'Новый пароль не должен быть пустым',
                'new_pass.min' => 'Новый пароль должен содержать не менее 5 символов',
                'con_pass.required' => 'Подтверждение пароля не должен быть пустым',
            ]);
        if (Hash::check($request->cur_pass, $user->password) && $request->new_pass == $request->con_pass) {
            $user->password = Hash::make($request->new_pass);
            $user->save();
            $message = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $headers = 'From: '. "webmaster@$_SERVER[HTTP_HOST] \r\n" .
            'X-Mailer: PHP/' . phpversion();
            session()->flash('success', 'Пароль успешно обновлен');
            return back();
        } else {
            session()->flash('alert', 'Пароль не изменен');
            return back();

        }
    }

    public function userPasschange(Request $request, $id) {
        $user = User::find($id);
        $password = @$request->password;
        $password_confirmation = @$request->password_confirmation;
        if(!@$password || !@$password_confirmation) {
            session()->flash('alert', 'Введите пароль в оба поля ввода');
            return back();
        }
        if(@$password != @$password_confirmation) {
            session()->flash('alert', 'Введённые пароли не совпадают');
            return back();
        }
        if(strlen(@$password) < 6) {
            session()->flash('alert', 'Пароль не может быть меньше 6 символов');
            return back();
        }
        if(strlen(@$password) > 32) {
            session()->flash('alert', 'Пароль не может быть больше 32 символов');
            return back();
        }
        $user->password = Hash::make(@$password);
        $user->save();
        session()->flash('success', 'Пароль пользователя успешно изменён');
        return back();
    }

    // Система промокодов

    public function promosList(Request $request) {
        $general = $this->general;
        $user = User::where('id', '=', @Auth::user()->id)->first();
        $promos = Promos::all();
        return view('admin.promosList', compact('general', 'user', 'promos'));
    }
    public function promosListAdds(Request $request) {
        if(@!$request->code) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите код промокода'
            );
            return response()->json($data);
        }
        if(empty($request->type) && $request->type != 0) {
            $data = array(
                'type' => 'warning',
                'message' => 'Категория не выбрана, обновите страницу'
            );
            return response()->json($data);
        }
        if(@!$request->desc) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите описание промокода'
            );
            return response()->json($data);
        }
        if(@!$request->value || @!$request->value < 0) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите корректное значение размера скидки'
            );
            return response()->json($data);
        }

        $promo = new Promos;
        $promo->code = $request->code;
        $promo->desc = $request->desc;
        $promo->type = $request->type;
        $promo->value = $request->value;
        $promo->active = $request->active;
        $promo->save();


        if(@$promo) {
            $data = array(
                'type' => 'success',
                'message' => 'Промокод '.@$request->code.' успешно добавлен'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Промокод не был добавлен, проверьте данные'
            );
            return response()->json($data);
        }
    }
    public function promosListSave(Request $request) {
        $id = @$request->id;
        $active = (@$request->active == 1) ? 1 : 0;
        $promo = Promos::where('id', '=', @$id)->first();
        if(@!$promo->id) {
            $data = array(
                'type' => 'warning',
                'message' => 'Не передан параметр ID, обновите страницу'
            );
            return response()->json($data);
        }
        if(@!$request->code) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите код промокода'
            );
            return response()->json($data);
        }
        if(empty($request->type) && $request->type != 0) {
            $data = array(
                'type' => 'warning',
                'message' => 'Категория не выбрана, обновите страницу'
            );
            return response()->json($data);
        }
        if(@!$request->desc) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите описание промокода'
            );
            return response()->json($data);
        }
        if(@!$request->value || @!$request->value < 0) {
            $data = array(
                'type' => 'warning',
                'message' => 'Введите корректное значение размера скидки'
            );
            return response()->json($data);
        }

        $promo->code = $request->code;
        $promo->desc = $request->desc;
        $promo->type = $request->type;
        $promo->value = $request->value;
        $promo->active = $request->active;
        $promo->save();

        if(@$promo) {
            $data = array(
                'type' => 'success',
                'message' => 'Промокод '.@$request->code.' успешно сохранен'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Промокод не был сохранен, проверьте данные'
            );
            return response()->json($data);
        }
    }
    public function promosListDels(Request $request) {
        $id = @$request->id;
        $promo = Promos::where('id', '=', @$id)->first();
        $delete = Promos::where('id', '=', @$id)->delete();
        if(@$delete) {
            $data = array(
                'type' => 'success',
                'message' => 'Промокод '.@$promo->code.' успешно удален'
            );
            return response()->json($data);
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Промокод #'.@$id.' уже удален или не существует'
            );
            return response()->json($data);
        }
    }
}
