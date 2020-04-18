<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeethroughcardController extends Controller
{
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
            if ($seethroughuser->name === $request->targetName) {
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
}
