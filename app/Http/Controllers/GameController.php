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
    public function initialization() //初期化&カード分配=>データベース保存
    {
        Card::truncate(); Killcard::truncate(); Deadcard::truncate();
        $cards = [1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8,9,10];
        shuffle($cards);
        $users = User::where( 'group_id' , '1' )->get();
        foreach ( $users as $key => $user ) {
            if( $user->card_2 ) { $user->card_2 = null; }
            $user->card_1 = array_shift($cards);
            $user->update();
        }
        $killcard = array_pop($cards);
        $storekillcard = new Killcard;
        $storekillcard->card_number = $killcard;
        $storekillcard->save();
        foreach ($cards as $card) {
            $storecard = new card;
            $storecard->card_number = $card;
            $storecard->save();
        }
        return redirect()->route('groups.index');
    }

    public function drawCard()
    {
        $drawCard = Card::first();
        $user = User::find(Auth::id());
        if (isset($user->card_1) && isset($user->card_2)) {
            return redirect()->route('groups.index')->with('message','カードを使用してください');
        } if (isset($user->card_1) && !isset($user->card_2)) {
            $user->card_2 = $drawCard->card_number;
            $user->save();
            $drawCard->delete();
            return redirect()->route('groups.index');
        }
        $user->card_1 = $drawCard->card_number;
        $user->save();
        $drawCard->delete();
        return redirect()->route('groups.index');
    }

    public function drawKillCard()
    {
        $drawKillCard = Killcard::first();
        $user = User::find(Auth::id());
        if (!isset($user->card_1) && !isset($user->card_2)) {
            $user->card_1 = $drawKillCard->card_number;
            $user->save();
            $drawKillCard->delete();
            return redirect()->route('groups.index');
        }
        return redirect()->route('groups.index')->with('message',"転生札を引くためにはカードを全て捨ててください");
    }

    public function discard(Request $request)
    {
        $user = Auth::user();
        if($request->discard === 'left') {
            $user = User::find(Auth::id());
            $deadcard = new Deadcard;
            $deadcard->card_number = $user->card_1;
            $deadcard->save();
            $user->card_1 = null;
            $user->save();
            return redirect()->route('groups.index');
        } elseif ($request->discard === 'right') {
            $deadcards = new Deadcard;
            $deadcards->card_number = $user->card_2;
            $deadcards->save();
            $user->card_2 = null;
            $user->save();
            return redirect()->route('groups.index');
        }
        return redirect()->route('groups.index')->with('message', '捨てるカードがありません');
    }

    public function  cardShuffle()
    {
        $user = User::find(Auth::id());
        $userCard_1 = $user->card_1;
        if ( (null !== $user->card_1) && (null !== $user->card_2) ) {
            $user->card_1 = $user->card_2;
            $user->card_2 = $userCard_1;
            $user->save();
            return redirect()->route('groups.index');
        }
        return redirect()->route('groups.index')->with('message', 'シャッフルできるのはカードが2枚の時だけです。');
    }

    public function selectCard()
    {
        $user = User::find(Auth::id());
        if ((isset($user->card_1) && !isset($user->card_2))||(!isset($user->card_1) && isset($user->card_2))) {
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
        return redirect()->route('groups.index')->with('message',"手札を1枚にしてね。不正ダメ、絶対");
    }

    public function selectedCard(Request $request)
    {
        $selectedCardNumber = $request->selectedCard;
        $selectedCard = Card::where('select_card','1')->where('card_number',$selectedCardNumber)->first();
        $user = User::find(Auth::id());
        if(isset($user->card_1) && isset($user->card_2) || !isset($user->card_1) && !isset($user->card_2)) {
            return redirect()->route('groups.index')->with('message',"手札を1枚にしてね。不正ダメ、絶対");
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

        return redirect()->route('groups.index');
    }

    public function exchangeCard ()
    {
        $exchangeusers = User::where('group_id', '1')->get();
        foreach ($exchangeusers as $exchangeuser) {
            $exchangeuser->exchange_user = Auth::id();
            $exchangeuser->update();
        }
        return redirect()->route('groups.index');
    }
    
    public function exchangedCard(Request $request)
    {
        $targetUser = User::where('name',$request->targetName)->first();
        $targetUserHasCardNumber_1 = $targetUser->card_1;
        $targetUserHasCardGudgment_1 = isset($targetUser->card_1);
        $targetUserHasCardNumber_2 = $targetUser->card_2;
        $targetUserHasCardGudgment_2 = isset($targetUser->card_2);
        $authUser = Auth::user();
        $authUserHasCardNumber_1 = $authUser->card_1;
        $authUserHasCardGudgment_1 = isset($authUser->card_1);
        $authUserHasCardNumber_2 = $authUser->card_2;
        $authUserHasCardGudgment_2 = isset($authUser->card_2);

        if ( $authUserHasCardGudgment_1 === $targetUserHasCardGudgment_1 )
        {
            $authUser->card_1 = $targetUserHasCardNumber_1;
            $targetUser->card_1 = $authUserHasCardNumber_1;
            $targetUser->save();
            $authUser->save();
        } 
        if ($authUserHasCardGudgment_2 === $targetUserHasCardGudgment_1)
        {
            $authUser->card_2 = $targetUserHasCardNumber_1;
            $targetUser->card_1 = $authUserHasCardNumber_2;
            $targetUser->save();
            $authUser->save();
        } 
        if ($authUserHasCardGudgment_1 === $targetUserHasCardGudgment_2)
        {
            $authUser->card_1 = $targetUserHasCardNumber_2;
            $targetUser->card_2 = $authUserHasCardNumber_1;
            $targetUser->save();
            $authUser->save();
        } 
        if ($authUserHasCardGudgment_2 === $targetUserHasCardGudgment_2)
        {
            $authUser->card_2 = $targetUserHasCardNumber_2;
            $targetUser->card_2 = $authUserHasCardNumber_2;
            $targetUser->save();
            $authUser->save();
        }
        return redirect()->route('groups.index');
    }

}