<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Card;
use App\DeadCard;
use App\Group;
use Auth;

class PlagueCardController extends Controller
{
    public function plagueCard(Group $group)// カード効果5疫病(対象表示)
    {
        $groupWitnUsers = Group::GroupWithUsers($group)->first();

        foreach ($groupWitnUsers->users as $plagueuser) {
            $plagueuser->plague_user = Auth::id();
            $plagueuser->update();
        }
        return redirect()->route('groups.show', [$group->id]);
    }

    public function plaguedCard(Group $group,Request $request)// カード効果5疫病(リクエスト処理 return 右か左か)
    {
        $group = Group::GroupWithUsersCardsDeadCardsKillCard($group)->first();
        $users = $group->users;
        $targetuser = $users->where('name', $request->targetName)->first();
        $drawCard = $group->cards->first();

        foreach ($users as $user) {
            $user->plague_user = null;
            $user->save();
        }
        $targetuser->plaguetarget = Auth::id();
        if ( isset($targetuser->card_1) && isset($targetuser->card_2) ) {
            return redirect()->route('groups.show', [$group->id])->with('message','カードを使用してください');
        } if ( isset($targetuser->card_1) && !isset($targetuser->card_2) ) {
            $targetuser->card_2 = $drawCard->card_number;
            $targetuser->save();
            $drawCard->delete();
            return redirect()->route('groups.show', [$group->id]);
        }
        $targetuser->card_1 = $drawCard->card_number;
        $targetuser->save();
        $drawCard->delete();
        return redirect()->route('groups.show', [$group->id]);
    }

    public function plaguedLeftOrRightCard(Group $group,Request $request)// カード効果5疫病(リクエスト処理)
    {
        $group = Group::GroupWithUsersCardsDeadCardsKillCard($group)->first();
        $targetuser = $group->users->where('plaguetarget', Auth::id())->first();

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
        return redirect()->route('groups.show', [$group->id]);
    }

}
