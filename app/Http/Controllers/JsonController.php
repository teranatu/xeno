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
        for ($i=1; $i < 11; $i++) { ${'inRoomUserPublicExecute_'.$i} = []; }

        for ($i=1; $i < 11 ; $i++) {
            ${'inRoomUsersDetails_'.$i} = User::where('group_id',$i)->get();
            $inRoomUsersDetails[] = ${'inRoomUsersDetails_'.$i};
            $group = Group::where('id', $i)->first();
            dd($group);
            if (null === $group->publicexecutecard_1) {
                ${'inRoomUserPublicExecute_'.$i}[] = null;
            } if (null === $group->publicexecutecard_2) {
                ${'inRoomUserPublicExecute_'.$i}[] = null;
            }
            if (null !== $group->publicexecutecard_1) {
                ${'inRoomUserPublicExecute_'.$i}[] = $group->publicexecutecard_;
            } if (null !== $group->publicexecutecard_2) {
                ${'inRoomUserPublicExecute_'.$i}[] = $group->publicexecutecard_;
            }
            $inRoomPublicexectute[] = ${'inRoomUserPublicExecute_'.$i};

        }
        $json = [
            "inRoomUsersDetails" => $inRoomUsersDetails,
            "inRoomPublicexectute" => $inRoomPublicexectute,
        ];
    return response()->json($json);
    }

    public function isCountInRoomUsers() // ルームを使用しているユーザー情報
    {
        for ($i=1; $i < 11 ; $i++) {
            ${'inRoomUsers_'.$i} = count( User::where('group_id',$i)->get() );
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
