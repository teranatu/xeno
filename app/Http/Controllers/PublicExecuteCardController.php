<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Card;
use App\DeadCard;
use App\Group;
use Auth;

class PublicExecuteCardController extends Controller
{
    public function publicExecuteCard(Group $group) //カード効果1&9公開処刑(対象表示)
    {
        $groupWitnUsers = Group::GroupWithUsers($group)->first();

        foreach ($groupWitnUsers->users as $user) {
            $user->publicexcute_user = Auth::id();
            $user->update();
        }
        return redirect()->route('groups.show', [$group->id])->with('message','公開処刑する対象を選択してください。');
    }

    public function publicExecutedCard(Group $group,Request $request) //カード効果1&9公開処刑(リクエスト処理)
    {
        $group = Group::GroupWithUsersCardsDeadCardsKillCard($group)->first();
        $users = $group->users;
        $targetuser = $users->where('name', $request->targetName)->first();
        $drawCard = $group->cards->first();

        foreach ($users as $user) {
            $user->publicexcute_user = null;
            $user->save();
        }
        $targetuser->publicexcutetarget = Auth::id();
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
}
