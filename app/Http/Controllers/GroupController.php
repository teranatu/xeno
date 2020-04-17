<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Card;
use App\Group;
use Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $groupNumber = (int)$request->group;
        for ($i=1; $i < 11; $i++) { 
            if ($groupNumber === $i) {
                if ( User::where('group_id', $i)->count() === 4 ) {
                    return redirect('groups')->with('message',"部屋{{ $groupNumber }}は満員です");
                }
                if ( User::where('group_id', $i)->count() === 3 ) {
                    $group = Group::where('group_id', $groupNumber)->first();
                    $group->group_user_id_3 = Auth::id();
                    $group->save();
                    $user = User::where('id', Auth::id())->first();
                    $user->group_id = $request->group;
                    $user->update();
                    return redirect()->route('groups.show', [$group->group_id] );
                }
                if ( User::where('group_id', $i)->count() === 2 ) {
                    $group = Group::where('group_id', $groupNumber)->first();
                    $group->group_user_id_3 = Auth::id();
                    $group->save();
                    $user = User::where('id', Auth::id())->first();
                    $user->group_id = $request->group;
                    $user->update();
                    return redirect()->route('groups.show', [$group->group_id] );
                }
                if ( User::where('group_id', $i)->count() === 1 ) {
                    $group = Group::where('group_id', $groupNumber)->first();
                    $group->group_user_id_2 = Auth::id();
                    $group->save();
                    $user = User::where('id', Auth::id())->first();
                    $user->group_id = $request->group;
                    $user->update();
                    return redirect()->route('groups.show', [$group->group_id] );
                }
                if ( User::where('group_id', $i)->count() === 0 ) {
                    $group = new Group;
                    $group->group_id = $groupNumber;
                    $group->group_user_id_1 = Auth::id();
                    $group->save();
                    $user = User::where('id', Auth::id())->first();
                    $user->group_id = $request->group;
                    $user->update();
                    return redirect()->route('groups.show', [$group->group_id] );
                }
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($group)
    {
        $selectcards = Card::where( 'select_card','1' )->get();
        $users = User::where( 'group_id', Auth::user()->group_id )->get();

        //条件①選択されたカードがある時カードを受け渡す
        if( (0 !== count($selectcards)) && (2 !== count($selectcards)) ) { 
            foreach ($selectcards as $key => $selectcard ) {
                ${'selectcard_'.($key+1)} = $selectcard->card_number;
            }
            return view('room',compact('users','selectcard_1','selectcard_2','selectcard_3','group'));
        }
        //条件②透視するユーザーを選択していた場合
        if ( null !== (Auth::user()->seethroughedcard) ) {
            $seeThroughedCard = Auth::user()->seethroughedcard;
            return view('room',compact('users','seeThroughedCard', 'group'));
        }
        //条件③メッセージがあればそれにリダイレクト。
        if (isset($message)) {
            return view('room',compact('users', 'group'))->with('message', 'カードを使用してください');
        }
        
        return view('room',compact('users', 'group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
