<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Card;
use App\Killcard;
use App\Deadcard;
use Auth;

class GameController extends Controller
{
    public function initialization() {
        $cards = [1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8,9,10];
        shuffle($cards);
        $users = User::where('group_id', '1')->get();
        foreach ($users as $key => $user) {
            switch ($key) {
                case 0:
                    if(isset($user->card_2)) {
                        $user->card_2 = null;
                    }
                    $user->card_1 = array_shift($cards);
                    $user->update();
                break;
                case 1:
                    if(isset($user->card_2)) {
                        $user->card_2 = null;
                    }
                    $user->card_1 = array_shift($cards);
                    $user->update();
                break;
                case 2:
                    if(isset($user->card_2)) {
                        $user->card_2 = null;
                    }
                    $user->card_1 = array_shift($cards);
                    $user->update();
                break;
                case 3:
                    if(isset($user->card_2)) {
                        $user->card_2 = null;
                    }
                    $user->card_1 = array_shift($cards);
                    $user->update();
                break;
            }
        }
        DB::table('cards')->truncate();
        $killcard = array_pop($cards);
        foreach ($cards as $card) {
            $storecard = new card;
            $storecard->card_number = $card;
            $storecard->save();
        }
        DB::table('killcards')->truncate();
        $KillCard = Killcard::all();
        $storekillcard = new Killcard;
        $storekillcard->card_number = $killcard;
        $storekillcard->save();
        
        return redirect()->route('groups.index');
    }

    public function drawCard() {
        $drawCard = Card::first();
        $user = User::find(Auth::id());
        if (isset($user->card_1) && !isset($user->card_2)) {
            $user->card_2 = $drawCard->card_number;
            $user->save();
            $drawCard->delete();
        } elseif (!isset($user->card_1) && isset($user->card_2)) {
            $user->card_1 = $drawCard->card_number;
            $user->save();
            $drawCard->delete();
        }elseif (!isset($user->card_1) && !isset($user->card_2)) {
            $user->card_1 = $drawCard->card_number;
            $user->save();
            $drawCard->delete();
        }
        return redirect()->route('groups.index');
    }

    public function drawKillCard() {
        $drawKillCard = Killcard::first();
        $user = User::find(Auth::id());
        if (isset($user->card_1) && !isset($user->card_2)) {
            $user->card_2 = $drawKillCard->card_number;
            $user->save();
            $drawKillCard->delete();
        } elseif (!isset($user->card_1) && isset($user->card_2)) {
            $user->card_1 = $drawKillCard->card_number;
            $user->save();
            $drawKillCard->delete();
        }
        return redirect()->route('groups.index');
    }

    public function discardLeft() {
        $user = User::find(Auth::id());
        $deadcard = new Deadcard;
        $deadcard->card_number = $user->card_1;
        $deadcard->save();
        $user->card_1 = null;
        $user->save();
        return redirect()->route('groups.index');
    }

    public function discardRight() {
        $user = User::find(Auth::id());
        $deadcards = new Deadcard;
        $deadcards->card_number = $user->card_2;
        $deadcards->save();
        $user->card_2 = null;
        $user->save();
        return redirect()->route('groups.index');
    }

    public function isCount() {
        $isCountCards = count(Card::all());
        $isCountKillCards = count(Killcard::all());
        $inRoomUsers = count(User::where('group_id', '1')->get());
        $users = User::where('group_id', '1')->get();
        $usedcard = Deadcard::all()->sortByDesc('id')->first();
        $usedCard = $usedcard->card_number;

        //墓地のカードをカウントしてjsonでぶん投げる
        
        $json = [
                "isCountCards" => $isCountCards,
                "inRoomUsers" => $inRoomUsers,
                "users" => $users,
                "isCountKillCards" => $isCountKillCards,
                "usedCard" => $usedCard
                ];
        return response()->json($json);
    }
}