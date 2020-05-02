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
        $group = Group::where('id', $groupNumber)->first();
        $user = User::where('id', Auth::id())->first();
        $groupsInOrNot = Group::where('group_user_id_1', Auth::id())
        ->orWhere('group_user_id_2', Auth::id())
        ->orWhere('group_user_id_3', Auth::id())
        ->orWhere('group_user_id_4', Auth::id())
        ->get();
        if ( 0 === count($groupsInOrNot)) {

            if ( !isset($group->group_user_id_1) ) {
                $group->group_user_id_1 = Auth::id();
                $group->save();
                $user->group_id = $request->group;
                $user->group_number = 1;
                $user->update();
                return redirect()->route('groups.show', [$group->id] );
            } if ( !isset($group->group_user_id_2) ) {
                $group->group_user_id_2 = Auth::id();
                $group->save();
                $user->group_id = $request->group;
                $user->group_number = 2;
                $user->update();
                return redirect()->route('groups.show', [$group->id] );
            } if ( !isset($group->group_user_id_3) ) {
                $group->group_user_id_3 = Auth::id();
                $group->save();
                $user->group_id = $request->group;
                $user->group_number = 3;
                $user->update();
                return redirect()->route('groups.show', [$group->id] );
            } if ( !isset($group->group_user_id_4) ) {
                $group->group_user_id_4 = Auth::id();
                $group->save();
                $user->group_id = $request->group;
                $user->group_number = 4;
                $user->update();
                return redirect()->route('groups.show', [$group->id] );
            } else {
                return redirect('groups')->with('message',"部屋{{ $groupNumber }}は満員です");
            }

        }
        return redirect()->route('groups.show', [$group->id] )->with('message',"所属している部屋があります。");
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        $selectcards = Card::where( 'select_card','1' )->get();
        $users = User::where( 'group_id', Auth::user()->group_id )->get();
        $groupdetails = $group;
        $group = $group->id;
        //条件①選択されたカードがある時カードを受け渡す
        if( (0 !== count($selectcards)) && (2 !== count($selectcards)) ) { 
            foreach ($selectcards as $key => $selectcard ) {
                ${'selectcard_'.($key+1)} = $selectcard->card_number;
            }
            return view('room',compact('users','selectcard_1','selectcard_2','selectcard_3','group','groupdetails'));
        }
        //条件②透視されたカードが存在していた場合
        if ( null !== (Auth::user()->seethroughedcard) ) {
            $seeThroughedCard = Auth::user()->seethroughedcard;
            return view('room',compact('users','seeThroughedCard', 'group','groupdetails'));
        }
        //条件③メッセージがあればそれにリダイレクト。
        
        return view('room',compact('users', 'group','groupdetails'));
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
