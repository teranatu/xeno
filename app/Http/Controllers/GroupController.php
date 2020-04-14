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
        $selectcards = Card::where( 'select_card','1' )->get();
        $users = User::where( 'group_id', Auth::user()->group_id )->get();

        //条件①選択されたカードがある時カードを受け渡す
        if( (0 !== count($selectcards)) && (2 !== count($selectcards)) ) { 
            foreach ($selectcards as $key => $selectcard ) {
                ${'selectcard_'.($key+1)} = $selectcard->card_number;
            }
            return view('room',compact('users','selectcard_1','selectcard_2','selectcard_3'));
        }
        return view('room',compact('users'));
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
                    return redirect('/home')->with('message',"'部屋'{{ $i }}'は満員です'");
                }
                $group = new Group;
                $group->user_id = Auth::id();
                $group->save();
                $user = User::where('id', Auth::id())->first();
                $user->group_id = $request->group;
                $user->update();
                return redirect()->route('groups.index');
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
