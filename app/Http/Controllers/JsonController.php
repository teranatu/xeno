<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Group;
use App\Card;
use App\Killcard;
use App\Deadcard;
use Auth;
use Carbon\Carbon;

class JsonController extends Controller
{
    public function isCount() // グループ毎のカード情報
    {
        $groups = Group::with('users','cards','deadcards','killcard')->get();
        $isCountGroupUsedCard = [];
        $isCountGroupKillCard = [];
        $isCountGroupCards = [];
        $isCountGroupDeadCards = [];
        
        foreach ($groups as $key => $group) {
            $key = ($key + 1);
            ${'isCountGroup_'.$key.'_cards'} = count($group->cards);
            $isCountGroupCards[] = ${'isCountGroup_'.$key.'_cards'};

            if ( is_null($group->killcard) ) { ${'isCountGroup_'.$key.'_killCard'} = 0; }
            if ( !is_null($group->killcard) ) { ${'isCountGroup_'.$key.'_killCard'} = 1; }
            $isCountGroupKillCard[] = ${'isCountGroup_'.$key.'_killCard'};

            if ( null !==  $group->deadcards->sortByDesc('id')->first() ) {
                ${'isCountGroup_'.$key.'_usedCard'} = $group->deadcards->sortByDesc('id')->first()->card_number;
            } else {
                ${'isCountGroup_'.$key.'_usedCard'} = null;
            }
            $isCountGroupUsedCard[] = ${'isCountGroup_'.$key.'_usedCard'};

            ${'isCountGroup_'.$key.'_deadCards'} = [];
            for ($i=1; $i < 11; $i++) { ${'Group_'.$key.'_deadCard_'.$i} = 0; }
                foreach ($group->deadcards as $deadcard) {
                    for ($i=1; $i < 11 ; $i++) {
                        if($i == $deadcard->card_number) { ${'Group_'.$key.'_deadCard_'.$i}++ ; }
                    }
            }
            for ($i=1; $i < 11; $i++) { 
            ${'isCountGroup_'.$key.'_deadCards'}[] = ${'Group_'.$key.'_deadCard_'.$i};
            }

            $isCountGroupDeadCards[] = ${'isCountGroup_'.$key.'_deadCards'}; 
        }
        $json = [
            "isCountGroupCards" => $isCountGroupCards,
            "isCountGroupKillCard" => $isCountGroupKillCard,
            "isCountGroupUsedCard" => $isCountGroupUsedCard,
            "isCountGroupDeadCards" => $isCountGroupDeadCards,
            
        ];
        return response()->json($json);
    }

    public function isCountInRoomUsersDetails() // グループ毎のユーザー情報
    {
        $inRoomUsersDetails = [];
        $inRoomPublicexectute = [];
        $date = Carbon::now();

        for ($i=1,$ii=1; $i < 11 ; $i++,$ii += 10) {
            ${'inRoomUsersDetails_'.$i} = User::where('group_id',$ii)->orderBy('group_number', 'asc')->get(['name','card_1','card_2']);
            foreach(${'inRoomUsersDetails_'.$i} as $user){
                if(null !== $user->card_1) $user->card_1 = $user->card_1 * (int)$date->format('d');
                if(null !== $user->card_2) $user->card_2 = $user->card_2 * (int)$date->format('m');
            };
            $inRoomUsersDetails[] = ${'inRoomUsersDetails_'.$i};
            ${'group_'.$i} = Group::where('id', $ii)->first();
            
            $inRoomPublicexectute[] = ${'group_'.$i};

        }
        $json = [
            "inRoomUsersDetails" => $inRoomUsersDetails,
            "inRoomPublicexectute" => $inRoomPublicexectute,
        ];
    return response()->json($json);
    }

    public function isCountInRoomUsers() // ルームを使用しているユーザー情報
    {
        for ($i=1,$ii=1; $i < 11 ; $i++,$ii += 10) {
            ${'inRoomUsers_'.$i} = count( User::where('group_id',$ii)->get() );
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
