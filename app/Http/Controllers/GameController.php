<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Card;
use App\Killcard;
use App\Deadcard;
use App\Group;
use Auth;

class GameController extends Controller
{
    public function initialization(Group $group) //初期化&カード分配=>保存 *複数ルーム対応済
    {
        $group = Group::GroupWithUsersCardsDeadCardsKillCard($group)->first();
        $groupUsers = $group->users;
        $groupCards = $group->cards;
        $groupDeadCards = $group->deadcards;

        if( 0 !== count($groupCards) ) {
            foreach ($groupCards as $groupCard) {
                $groupCard->delete();
            }
        } if (0 !== count($groupDeadCards)) {
            foreach ($groupDeadCards as $groupDeadCard) {
                $groupDeadCard->delete();
            }
        } if (null !== $group->killcard) { $group->killcard->delete(); }
        $cards = [1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8,9,10];
        shuffle($cards);
        foreach ( $groupUsers as $groupUser ) {
            if( $groupUser->card_2 ) { $groupUser->card_2 = null; }
            $groupUser->card_1 = array_shift($cards);
            $groupUser->update();
        }
        $killcard = array_pop($cards);
        $storekillcard = new Killcard;
        $storekillcard->card_number = $killcard;
        $storekillcard->group_id = Auth::user()->group_id;
        $storekillcard->save();
        foreach ($cards as $card) {
            $storecard = new card;
            $storecard->card_number = $card;
            $storecard->group_id = Auth::user()->group_id;
            $storecard->save();
        }
        return redirect()->route('groups.show', [ $group->group_id ])->with('message', '初期化が完了しました。');
    }

    public function drawCard(Group $group) //カードを引く=>保存 *複数ルーム対応済
    {   
        $group = Group::GroupWithUsersCardsDeadCardsKillCard($group)->first();
        $drawUser = $group->users->where( 'id', Auth::id() )->first();
        $drawCard = $group->cards->first();

        if (isset($drawUser->card_1) && isset($drawUser->card_2)) {
            return redirect()->route('groups.show', [ $group->group_id ])->with('message', '手札が２枚です。捨ててください。');
        } if (isset($drawUser->card_1) && !isset($drawUser->card_2)) {
            $drawUser->card_2 = $drawCard->card_number;
            $drawUser->save();
            $drawCard->delete();
            return redirect()->route('groups.show', [ $group->group_id ])->with('message', 'カードをひきました。');
        }
        $drawUser->card_1 = $drawCard->card_number;
        $drawUser->save();
        $drawCard->delete();
        return redirect()->route('groups.show', [ $group->group_id ])->with('message', 'カードをひきました。');
    }

    public function drawKillCard(Group $group) //転生札を引く *複数ルーム対応済
    {
        $group = Group::GroupWithUsersCardsDeadCardsKillCard($group)->first();
        $drawUser = $group->users->where( 'id', Auth::id() )->first();
        $drawKillCard = $group->KillCard->first();

        if ( !isset($drawUser->card_1) && !isset($drawUser->card_2) ) {
            $drawUser->card_1 = $drawKillCard->card_number;
            $drawUser->save();
            $drawKillCard->delete();
            return redirect()->route('groups.show');
        }
        return redirect()->route('groups.show', [ $group->group_id ])->with('message',"転生札を引くためにはカードを全て捨ててください");
    }

    public function discard(Request $request,Group $group) //カードを捨てる *複数ルーム対応済
    {
        $discardUser = Auth::user();
        if ( ($discardUser->card_1 === null) && ($discardUser->card_2 === null) ) {
            return redirect()->route('groups.show', [ $group->group_id ])->with('message', '捨てるカードがありません');
        }
        if ( ($request->discard === 'left') && ($discardUser->card_1 !== null) ) {
            $discardUser = User::find(Auth::id());
            $deadcard = new Deadcard;
            $deadcard->card_number = $discardUser->card_1;
            $deadcard->group_id = $discardUser->group_id;
            $deadcard->save();
            $discardUser->card_1 = null;
            $discardUser->save();
            return redirect()->route('groups.show', [ $group->group_id ]);
        } if ( ($request->discard === 'right') && ($discardUser->card_2 !== null) ) {
            $deadcards = new Deadcard;
            $deadcards->card_number = $discardUser->card_2;
            $deadcards->group_id = $discardUser->group_id;
            $deadcards->save();
            $discardUser->card_2 = null;
            $discardUser->save();
            return redirect()->route('groups.show', [ $group->group_id ]);
        }
    }

    public function cardShuffle() //カードをシャッフルする *複数ルーム対応済
    {
        $user = User::find(Auth::id());
        $userCard_1 = $user->card_1;
        if ( (null !== $user->card_1) && (null !== $user->card_2) ) {
            $user->card_1 = $user->card_2;
            $user->card_2 = $userCard_1;
            $user->save();
            return redirect()->route('groups.show');
        }
        return redirect()->route('groups.show')->with('message', 'シャッフルできるのはカードが2枚の時だけです。');
    }

    public function seeThroughCard()// カード効果3透視(対象表示)
    {
        $seethroughusers = User::where('group_id', '1')->get();
        foreach ($seethroughusers as $seethroughuser) {
            $seethroughuser->seethrough_user = Auth::id();
            $seethroughuser->update();
        }
        return redirect()->route('groups.show');
    }

    public function seeThroughedCard(Request $request)// カード効果3透視(リクエスト処理 return確認)
    {
        $seethroughusers = User::where('group_id', '1')->get();
        $authuser = $seethroughusers->where('id', Auth::id() )->first();

        foreach ($seethroughusers as $seethroughuser) {
            if($seethroughuser->name === $request->targetName) {
                if ( (null !== $seethroughuser->card_1) && (null === $seethroughuser->card_2) ) {
                    $authuser->seethroughedcard = $seethroughuser->card_1;
                    $authuser->save();
                }if ( (null === $seethroughuser->card_1) && (null !== $seethroughuser->card_2) ) {
                    $authuser->seethroughedcard = $seethroughuser->card_2;
                    $authuser->save();
                }
            }
            $seethroughuser->seethrough_user = null;
            $seethroughuser->save();
        }
        return redirect()->route('groups.show');
    }

    public function seeThroughedconfirmedCard(Request $request)// カード効果3透視(リクエスト処理)
    {
        $authUser = Auth::user();
        $authUser->seethroughedcard = null;
        $authUser->save();
        return redirect()->route('groups.show');

    }

    public function plagueCard()// カード効果5疫病(対象表示)
    {
        $plagueusers = User::where('group_id', '1')->get();
        foreach ($plagueusers as $plagueuser) {
            $plagueuser->plague_user = Auth::id();
            $plagueuser->update();
        }
        return redirect()->route('groups.show');
    }

    public function plaguedCard(Request $request)// カード効果5疫病(リクエスト処理 return 右か左か)
    {
        $targetuser = User::where('group_id', '1')->where('name', $request->targetName)->with('group.cards')->first();
        $drawCard = $targetuser->group->cards->first();
        $users = User::where('group_id', '1')->get();
        foreach ($users as $user) {
            $user->plague_user = null;
            $user->save();
        }
        $targetuser->plaguetarget = Auth::id();
        if ( isset($targetuser->card_1) && isset($targetuser->card_2) ) {
            return redirect()->route('groups.show')->with('message','カードを使用してください');
        } if ( isset($targetuser->card_1) && !isset($targetuser->card_2) ) {
            $targetuser->card_2 = $drawCard->card_number;
            $targetuser->save();
            $drawCard->delete();
            return redirect()->route('groups.show');
        }
        $targetuser->card_1 = $drawCard->card_number;
        $targetuser->save();
        $drawCard->delete();
        return redirect()->route('groups.show');
    }

    public function plaguedLeftOrRightCard(Request $request)// カード効果5疫病(リクエスト処理)
    {
        $targetuser = User::where('group_id', '1')->where('plaguetarget', Auth::id())->with('group.cards')->first();
        if( $request->plagued === 'left' ) {
            $deadcard = new Deadcard;
            $deadcard->card_number = $targetuser->card_1;
            $deadcard->save();
            $targetuser->card_1 = null;
            $targetuser->plaguetarget = null;
            $targetuser->save();
        }
        if ( $request->plagued === 'right' ) {
            $deadcard = new Deadcard;
            $deadcard->card_number = $targetuser->card_2;
            $deadcard->save();
            $targetuser->card_2 = null;
            $targetuser->plaguetarget = null;
            $targetuser->save();
        }
        return redirect()->route('groups.show');
    }

    public function selectCard() //カード効果7選択(対象表示)
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
            return redirect()->route('groups.show');
        }
        return redirect()->route('groups.show')->with('message',"手札を1枚にしてね。不正ダメ、絶対");
    }

    public function selectedCard(Request $request) //カード効果7選択(リクエスト処理)
    {
        $selectedCardNumber = $request->selectedCard;
        $selectedCard = Card::where('select_card','1')->where('card_number',$selectedCardNumber)->first();
        $user = User::find(Auth::id());
        if(isset($user->card_1) && isset($user->card_2) || !isset($user->card_1) && !isset($user->card_2)) {
            return redirect()->route('groups.show')->with('message',"手札を1枚にしてね。不正ダメ、絶対");
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

        return redirect()->route('groups.show');
    }

    public function exchangeCard () //カード効果8交換(対象表示)
    {
        $exchangeusers = User::where('group_id', '1')->get();
        foreach ($exchangeusers as $exchangeuser) {
            $exchangeuser->exchange_user = Auth::id();
            $exchangeuser->update();
        }
        return redirect()->route('groups.show');
    }
    
    public function exchangedCard(Request $request) //カード効果8交換(リクエスト処理)
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

            $exchangeusers = User::where('group_id', '1')->get();
            foreach ($exchangeusers as $exchangeuser) {
                $exchangeuser->exchange_user = null;
                $exchangeuser->update();
            }

        } 
        if ($authUserHasCardGudgment_2 === $targetUserHasCardGudgment_1)
        {
            $authUser->card_2 = $targetUserHasCardNumber_1;
            $targetUser->card_1 = $authUserHasCardNumber_2;
            $targetUser->save();
            $authUser->save();
            
            $exchangeusers = User::where('group_id', '1')->get();
            foreach ($exchangeusers as $exchangeuser) {
                $exchangeuser->exchange_user = null;
                $exchangeuser->update();
            }
        } 
        if ($authUserHasCardGudgment_1 === $targetUserHasCardGudgment_2)
        {
            $authUser->card_1 = $targetUserHasCardNumber_2;
            $targetUser->card_2 = $authUserHasCardNumber_1;
            $targetUser->save();
            $authUser->save();

            $exchangeusers = User::where('group_id', '1')->get();
            foreach ($exchangeusers as $exchangeuser) {
                $exchangeuser->exchange_user = null;
                $exchangeuser->update();
            }
        } 
        if ($authUserHasCardGudgment_2 === $targetUserHasCardGudgment_2)
        {
            $authUser->card_2 = $targetUserHasCardNumber_2;
            $targetUser->card_2 = $authUserHasCardNumber_2;
            $targetUser->save();
            $authUser->save();

            $exchangeusers = User::where('group_id', '1')->get();
            foreach ($exchangeusers as $exchangeuser) {
                $exchangeuser->exchange_user = null;
                $exchangeuser->update();
            }
        }
        return redirect()->route('groups.show');
    }

    public function publicExecuteCard() //カード効果1&9公開処刑(対象表示)
    {

    }

    public function publicExecutedCard() //カード効果1&9公開処刑(リクエスト処理)
    {

    }

}