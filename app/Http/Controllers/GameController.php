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
        return redirect()->route('groups.show', [ $group->id ])->with('message', '初期化が完了しました。');
    }

    public function drawCard(Group $group) //カードを引く=>保存 *複数ルーム対応済
    {   
        $group = Group::GroupWithUsersCardsDeadCardsKillCard($group)->first();
        $drawUser = $group->users->where( 'id', Auth::id() )->first();
        $drawCard = $group->cards->first();

        if (isset($drawUser->card_1) && isset($drawUser->card_2)) {
            return redirect()->route('groups.show', [ $group->id ])->with('message', '手札が２枚です。捨ててください。');
        } if (isset($drawUser->card_1) && !isset($drawUser->card_2)) {
            $drawUser->card_2 = $drawCard->card_number;
            $drawUser->save();
            $drawCard->delete();
            return redirect()->route('groups.show', [ $group->id ])->with('message', 'カードをひきました。');
        }
        $drawUser->card_1 = $drawCard->card_number;
        $drawUser->save();
        $drawCard->delete();
        return redirect()->route('groups.show', [ $group->id ])->with('message', 'カードをひきました。');
    }

    public function drawKillCard(Group $group) //転生札を引く *複数ルーム対応済
    {
        $group = Group::GroupWithUsersCardsDeadCardsKillCard($group)->first();
        $drawUser = $group->users->where( 'id', Auth::id() )->first();
        $drawKillCard = $group->KillCard->where('group_id', $group->id)->first();
        if ( !isset($drawUser->card_1) && !isset($drawUser->card_2) ) {
            $drawUser->card_1 = $drawKillCard->card_number;
            $drawUser->save();
            $drawKillCard->delete();
            return redirect()->route('groups.show', [ $group->id ])->with('message',"転生札を引きました。");
        }
        return redirect()->route('groups.show', [ $group->id ])->with('message',"転生札を引くためにはカードを全て捨ててください");
    }

    public function discard(Request $request,Group $group) //カードを捨てる *複数ルーム対応済
    {
        $discardUser = Auth::user();
        if ( ($discardUser->card_1 === null) && ($discardUser->card_2 === null) ) {
            return redirect()->route('groups.show', [ $group->id ])->with('message', '捨てるカードがありません');
        }
        if ( ($request->discard === 'left') && ($discardUser->card_1 !== null) ) {
            $discardUser = User::find(Auth::id());
            $deadcard = new Deadcard;
            $deadcard->card_number = $discardUser->card_1;
            $deadcard->group_id = $discardUser->group_id;
            $deadcard->save();
            $discardUser->card_1 = null;
            $discardUser->save();
            return redirect()->route('groups.show', [ $group->id ])->with('message', '左のカードを捨てました。');
        } if ( ($request->discard === 'right') && ($discardUser->card_2 !== null) ) {
            $deadcards = new Deadcard;
            $deadcards->card_number = $discardUser->card_2;
            $deadcards->group_id = $discardUser->group_id;
            $deadcards->save();
            $discardUser->card_2 = null;
            $discardUser->save();
            return redirect()->route('groups.show', [ $group->id ])->with('message', '右のカードを捨てました。');
        }
        return redirect()->route('groups.show', [ $group->id ])->with('message', '捨てるカードがありません');
    }

    public function cardShuffle(Group $group) //カードをシャッフルする *複数ルーム対応済
    {
        $user = User::find(Auth::id());
        $userCard_1 = $user->card_1;
        if ( (null !== $user->card_1) && (null !== $user->card_2) ) {
            $user->card_1 = $user->card_2;
            $user->card_2 = $userCard_1;
            $user->save();
            return redirect()->route('groups.show', [ $group->id ])->with('message', 'シャッフルが完了しました。');
        }
        return redirect()->route('groups.show', [ $group->id ])->with('message', 'シャッフルできるのはカードが2枚の時だけです。');
    }

}