<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Card;
use App\Group;
use Auth;

class SeethroughcardController extends Controller
{
    public function seeThroughCard(Group $group)// カード効果3透視(対象表示)
    {
        $groupWitnUsers = Group::GroupWithUsers($group)->first();
        foreach ($groupWitnUsers->users as $groupWitnUser) {
            $groupWitnUser->seethrough_user = Auth::id();
            $groupWitnUser->update();
        }
        return redirect()->route('groups.show', [$group->id]);
    }

    public function seeThroughedCard(Group $group,Request $request)// カード効果3透視(リクエスト処理 return確認)
    {
        $groupWitnUsers = Group::GroupWithUsers($group)->first();
        $groupAuthUser = $groupWitnUsers->users->where('id', Auth::id() )->first();

        foreach ($groupWitnUsers->users as $seethroughuser) {
            if ($seethroughuser->name === $request->targetName) {
                if ( (null !== $seethroughuser->card_1) && (null === $seethroughuser->card_2) ) {
                    $groupAuthUser->seethroughedcard = $seethroughuser->card_1;
                    $groupAuthUser->save();
                }if ( (null === $seethroughuser->card_1) && (null !== $seethroughuser->card_2) ) {
                    $groupAuthUser->seethroughedcard = $seethroughuser->card_2;
                    $groupAuthUser->save();
                }
            }
            $seethroughuser->seethrough_user = null;
            $seethroughuser->save();
        }
        return redirect()->route('groups.show', [$group->id]);
    }

    public function seeThroughedconfirmedCard(Group $group,Request $request)// カード効果3透視(リクエスト処理)
    {
        $authUser = Auth::user();
        $authUser->seethroughedcard = null;
        $authUser->save();
        return redirect()->route('groups.show', [$group->id]);

    }
}
