<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Card;
use App\DeadCard;
use App\Group;
use Auth;

class ExchangeCardController extends Controller
{
    public function exchangeCard (Group $group) //カード効果8交換(対象表示)
    {
        $group = Group::GroupWithUsers($group)->first();

        $users = $group->users;
        foreach ($users as $user) {
            $user->exchange_user = Auth::id();
            $user->update();
        }
        return redirect()->route('groups.show',[$group]);
    }
    
    public function exchangedCard(Group $group,Request $request) //カード効果8交換(リクエスト処理)
    {
        $group = Group::GroupWithUsers($group)->first();
        $users = $group->users;
        $targetUser = $group->users->where('name',$request->targetName)->first();

        $targetUserHasCardNumber_1 = $targetUser->card_1;
        $targetUserHasCardGudgment_1 = isset($targetUser->card_1);
        $targetUserHasCardNumber_2 = $targetUser->card_2;
        $targetUserHasCardGudgment_2 = isset($targetUser->card_2);
        $authUser = Auth::user();
        $authUserHasCardNumber_1 = $authUser->card_1;
        $authUserHasCardGudgment_1 = isset($authUser->card_1);
        $authUserHasCardNumber_2 = $authUser->card_2;
        $authUserHasCardGudgment_2 = isset($authUser->card_2);

        foreach ($users as $user) {
            $user->exchange_user = null;
            $user->update();
        }
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
        return redirect()->route('groups.show',[$group]);
    }

}
