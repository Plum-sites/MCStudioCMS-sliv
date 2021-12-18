<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
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

use App\Items;
use App\Category;
use App\GatewayUnitpay;
use App\GatewayFreekassa;
use App\GatewayTransact;
use App\GatewayPaylogs;
use App\GeneralSetting;
use App\Http\Lib\MinecraftQuery;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Обновление новостей
        $schedule->call(function () {
            $this->general = GeneralSetting::first();
            $get_link = "https://api.vk.com/method/wall.get";
            $get_news = file_get_contents($get_link."?from_group=1&extended=1&owner_id=-".@$this->general->vk_group_id."&count=".@$this->general->vk_output_count."&v=5.124&access_token=".@$this->general->vk_group_token);
            $get_news = json_decode($get_news);
            $get_news = json_encode($get_news, JSON_PRETTY_PRINT);
            $put_news = file_put_contents($_SERVER['DOCUMENT_ROOT']."/news.json", $get_news);
            return "[".date("d.m.Y H:i", time())."] News updated";
        })->everyFiveMinutes();

        // Обновление мониторинга
        $schedule->call(function () {
            $updated = 0;
            $servers = Servers::where('status', '=', 1)->get();
            foreach($servers as $server) {
                $serverQuery = new MinecraftQuery((@$server->ip == '0' || @$server->ip == '1') ? '127.0.0.1' : $server->ip, (@$server->port == '0' || @$server->port == '1') ? '25565' : $server->port, 10);
                if($serverQuery->connect()) {
                    $serverInfo = $serverQuery->get_info();
                    if($serverInfo['numplayers'] > $server->max_online) {
                        $server->max_online = $serverInfo['numplayers'];
                    }
                    if(@$serverInfo['numplayers'] ||@$serverInfo['numplayers'] == 0) {
                        $server->online = $serverInfo['numplayers'];
                    }
                    if(@$serverInfo['maxplayers']) {
                        $server->slots = $serverInfo['maxplayers'];
                    }
                    $server->save();
                    //return response()->json($serverInfo);
                    $updated++;
                }
            }
            if($updated >= 1) {
                $data = array(
                    'type' => 'success',
                    'message' => 'Successfully updated '.$updated.' servers'
                );
                return response()->json($data);
            } else {
                $data = array(
                    'type' => 'warning',
                    'message' => 'Servers not updated is connection failed'
                );
                return response()->json($data);
            }
        })->everyMinute();

        // Обновление привилегий
        $schedule->call(function () {
            $updated = 0;
            $privileges = UsersPrivileges::where('status', '=', 1)->get();
            foreach($privileges as $key => $privilege) {
                if(time() >= @$privilege->privilege_term) {
                    UsersPrivileges::where('id', '=', @$privilege->id)->delete();
                    UsersPrefixes::where([
                        ['user_id', '=', @$privilege->user_id],
                        ['server_id', '=', @$privilege->servers->id]
                    ])->delete();
                    $updated++;
                }
            }
            if($updated >= 1) {
                $data = array(
                    'type' => 'success',
                    'message' => 'Successfully cleared '.$updated.' privileges'
                );
                return response()->json($data);
            } else {
                $data = array(
                    'type' => 'warning',
                    'message' => 'Privileges not cleared because they are no'
                );
                return response()->json($data);
            }
        })->everyMinute();

        // Сброс рейтинга
        $schedule->call(function () {
            $clear = UsersRatings::truncate();
            if(@$clear) {
                $data = array(
                    'type' => 'success',
                    'message' => 'Successfully cleared votes'
                );
                return response()->json($data);
            } else {
                $data = array(
                    'type' => 'success',
                    'message' => 'Votes not cleared'
                );
                return response()->json($data);
            }
        })->monthly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
