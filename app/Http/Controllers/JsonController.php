<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Group;
use App\Card;
use App\Killcard;
use App\Deadcard;
use Auth;

class JsonController extends Controller
{
    public function isCount()
    {
        $isCountCards = count(Card::all());
        $isCountKillCards = count(Killcard::all());
        $inRoomUsers = count(User::where('group_id', '1')->get());
        if ( null !== ( Deadcard::all()->sortByDesc('id')->first() ) ){
            $usedcard = Deadcard::all()->sortByDesc('id')->first();
            $usedCard = $usedcard->card_number;
        }if ( null === ( Deadcard::all()->sortByDesc('id')->first() ) ) {
            $usedCard = null;
        }
        for ($i=1; $i < 11; $i++) { ${'Deadcard_'.$i} = 0; }
        $Deadcards = Deadcard::all();
        if (count($Deadcards)) {
            foreach ($Deadcards as $Deadcard) {
                for ($i=1; $i < 11 ; $i++) { 
                    if($i == $Deadcard->card_number) {
                        ${'Deadcard_'.$i}++ ;
                    }
                }
            }
        }
        $json = [
                "isCountCards" => $isCountCards,
                "inRoomUsers" => $inRoomUsers,
                "isCountKillCards" => $isCountKillCards,
                "usedCard" => $usedCard,
                "Deadcard_1" => $Deadcard_1,
                "Deadcard_2" => $Deadcard_2,
                "Deadcard_3" => $Deadcard_3,
                "Deadcard_4" => $Deadcard_4,
                "Deadcard_5" => $Deadcard_5,
                "Deadcard_6" => $Deadcard_6,
                "Deadcard_7" => $Deadcard_7,
                "Deadcard_8" => $Deadcard_8,
                "Deadcard_9" => $Deadcard_9,
                "Deadcard_10" => $Deadcard_10,
                ];
        return response()->json($json);
    }

    public function isCountInRoomUsersDetails()
    {
        for ($i=1; $i < 11 ; $i++) {
            ${'inRoomUsers_'.$i} = User::where('group_id',$i)->get();
        }
        $json = [
            "inRoomUsers_1" => $inRoomUsers_1,
            "inRoomUsers_2" => $inRoomUsers_2,
            "inRoomUsers_3" => $inRoomUsers_3,
            "inRoomUsers_4" => $inRoomUsers_4,
            "inRoomUsers_5" => $inRoomUsers_5,
            "inRoomUsers_6" => $inRoomUsers_6,
            "inRoomUsers_7" => $inRoomUsers_7,
            "inRoomUsers_8" => $inRoomUsers_8,
            "inRoomUsers_9" => $inRoomUsers_9,
            "inRoomUsers_10" => $inRoomUsers_10,
    ];
        
 
    return response()->json($json);
    }
}
