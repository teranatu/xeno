<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Card;

class GameController extends Controller
{
    public function initialization() {
        $cards = [1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8,9,10];
        shuffle($cards);
        $users = User::where('group_id', '1')->get();
        foreach ($users as $key => $user) {
            switch ($key) {
                case 0:
                    $user->card_1 = array_shift($cards);
                    $user->update();
                break;
                case 1:
                    $user->card_1 = array_shift($cards);
                    $user->update();
                break;
                case 2:
                    $user->card_1 = array_shift($cards);
                    $user->update();
                break;
                case 3:
                    $user->card_1 = array_shift($cards);
                    $user->update();
                break;
            }
        }
        
        DB::table('cards')->truncate();
        
        foreach ($cards as $card) {
            $storecard = new card;
            $storecard->card_number = $card;
            $storecard->save();
        }
        
        return view('room',compact('users'));
    }

    public function isCount()
{
    $isCountCards = count(Card::all());
    $inRoomUsers = count(User::where('group_id', '1')->get());

    $json = ["isCountCards" => $isCountCards,"inRoomUsers" => $inRoomUsers];
    return response()->json($json);
}
}