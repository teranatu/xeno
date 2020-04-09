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
        DB::table('deadcards')->truncate();
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
        if (!isset($user->card_1) && !isset($user->card_2)) {
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

    public function selectCard() {
        $selectcards = Card::take(3)->get();
        foreach ($selectcards as $selectcard ) {
            $selectcard->select_card = 1;
            $selectcard->save();
        }
        $select_user = Auth::user();
        $select_user->select_user  = Auth::id();
        $select_user->update();

        return redirect()->route('groups.index');
    }

    public function selectedCard(Request $request) {
        $selectedCardNumber = $request->selectedCard;
        $selectedCard = Card::where('select_card','1')->where('card_number',$selectedCardNumber)->first();
        $user = User::find(Auth::id());
        if (isset($user->card_1) && !isset($user->card_2)) {
            $user->card_2 = $selectedCard->card_number;
            $user->save();
            $selectedCard->delete();
            $selectedCards = Card::where('select_card','1')->get();
            foreach ($selectedCards as $nonselectCard) {
                $nonselectCard->select_card = 0;
                $nonselectCard->update();
            }

        } elseif (!isset($user->card_1) && isset($user->card_2)) {
            $user->card_1 = $selectedCard->card_number;
            $user->save();
            $selectedCard->delete();
            $selectedCards = Card::where('select_card','1')->get();
            foreach ($selectedCards as $nonselectCard) {
                $nonselectCard->select_card = 0;
                $nonselectCard->update();
            }
        }
        $select_user = Auth::user();
        $select_user->select_user  = null;
        $select_user->update();
        return redirect()->route('groups.index');
    }

    public function exchangeCard () {
        $exchangeusers = User::where('group_id', '1')->get();
        foreach ($exchangeusers as $exchangeuser) {
            $exchangeuser->exchange_user = Auth::id();
            $exchangeuser->update();
        }
        return redirect()->route('groups.index');
    }
    

    public function exchangedCard(Request $request) {
        $targetUser = User::where('name',$request->targetName)->first();
        $authUser = Auth::user()->first();

        $authUser->card_1 = $targetUser->card_1;
        $targetUser->card_1 = Auth::user()->card_1;
        $targetUser->save();
        $authUser->save();
        return redirect()->route('groups.index');
    }

    public function isCount() {
        $isCountCards = count(Card::all());
        $isCountKillCards = count(Killcard::all());
        $inRoomUsers = count(User::where('group_id', '1')->get());
        if (null !== (Deadcard::all()->sortByDesc('id')->first())){
            $usedcard = Deadcard::all()->sortByDesc('id')->first();
            $usedCard = $usedcard->card_number;
        }if (null === (Deadcard::all()->sortByDesc('id')->first())) {
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
}