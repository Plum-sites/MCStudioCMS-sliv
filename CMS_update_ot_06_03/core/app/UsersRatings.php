<?php

namespace App;

use App\User;
use App\Servers;
use App\GeneralSetting;
use App\RatingsSetting;

use Illuminate\Database\Eloquent\Model;

class UsersRatings extends Model {

    protected $table = "users_ratings";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function rewardSend($player = 'Admin') {
        $general = GeneralSetting::first();
        $ratings = RatingsSetting::first();
        $user = User::where('username', '=', @$player)->first();
        if(@$user->id) {
            $is_send = false;
            $vote_gift_type = (!@$ratings->vote_gift_type) ? '1' : @$ratings->vote_gift_type;
            $vote_gift_count = (!@$ratings->vote_gift_count) ? '1' : @$ratings->vote_gift_count;
            switch(@$vote_gift_type) {
                case '1':
                    $user->balance_game = @$user->balance_game + @$vote_gift_count;
                    $is_send = true;
                break;
                case '2':
                    $user->balance_real = @$user->balance_real + @$vote_gift_count;
                    $is_send = true;
                break;
                case '3':
                    $user->kits_game = @$user->kits_game + @$vote_gift_count;
                    $is_send = true;
                break;
            }
            if(@$is_send) {
                $votes_check = self::where('user_id', '=', @$user->id)->first();
                if(@$votes_check->id) {
                    @self::where('id', '=', @$votes_check->id)->update([
                        'votes' => @$votes_check->votes + 1
                    ]);
                } else {
                    @self::create([
                        'user_id' => @$user->id,
                        'votes' => '1',
                        'status' => '1'
                    ]);
                }
                $user->save();
                $data = array(
                    'type' => 'success',
                    'message' => 'Success: Gift send to user '.@$user->username
                );
                return response()->json($data);
            } else {
                $data = array(
                    'type' => 'warning',
                    'message' => 'Error: Gift not send to user'
                );
                return response()->json($data);
            }
        } else {
            $data = array(
                'type' => 'warning',
                'message' => 'Error: User not found'
            );
            return response()->json($data);
        }
    }

}
