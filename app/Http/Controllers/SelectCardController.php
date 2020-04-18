<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Card;
use App\DeadCard;
use App\Group;
use Auth;

class SelectCardController extends Controller
{
    public function selectCard(Group $group) //カード効果7選択(対象表示)
    {
        $group = Group::GroupWithUsersCardsDeadCardsKillCard($group)->first();
        $authuser = $group->users->where('id', Auth::id())->first();
        $selectcards = $group->cards->take(3);

        if ( (isset($authuser->card_1) && !isset($authuser->card_2)) || ( !isset($authuser->card_1) && isset($authuser->card_2)) ) {
            foreach ($selectcards as $selectcard ) {
                $selectcard->select_card = 1;
                $selectcard->save();
            }
            $authuser->select_user = Auth::id();
            $authuser->update();
            return redirect()->route('groups.show', [$group->id])->with('message',"3枚のうちから1枚を選んでください");
        }
        return redirect()->route('groups.show', [$group->id])->with('message',"手札を1枚にしてね。不正ダメ、絶対");
    }

    public function selectedCard(Group $group,Request $request) //カード効果7選択(リクエスト処理)
    {
        $selectedCardNumber = $request->selectedCard;
        $selectedCard = Card::where('select_card','1')->where('card_number',$selectedCardNumber)->first();
        $user = User::find(Auth::id());
        if(isset($user->card_1) && isset($user->card_2) || !isset($user->card_1) && !isset($user->card_2)) {
            return redirect()->route('groups.show', [$group->id])->with('message',"手札を1枚にしてね。不正ダメ、絶対");
        } elseif (isset($user->card_1) && !isset($user->card_2)) {
            $user->card_2 = $selectedCard->card_number;
        } elseif (!isset($user->card_1) && isset($user->card_2)) {
            $user->card_1 = $selectedCard->card_number;
        }
        $user->save();
        $selectedCard->delete();
        $selectedCards = Card::where('select_card','1')->get();
        foreach ($selectedCards as $nonselectCard) {
            $nonselectCard->select_card = 0;
            $nonselectCard->update();
        }
        $select_user = Auth::user();
        $select_user->select_user  = null;
        $select_user->update();

        $allCards = Card::all();
        $reSuffleCards = [];
        foreach ($allCards as $allCard) { $reSuffleCards[] = $allCard->card_number; }
        shuffle($reSuffleCards);
        foreach ($allCards as $allCard) { 
            $allCard->card_number = array_pop($reSuffleCards); 
            $allCard->update();
        }

        return redirect()->route('groups.show', [$group->id]);
    }
}
