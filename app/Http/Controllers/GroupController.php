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
    public function index() {
        $selectcards = Card::where('select_card','1')->get();
        
    if(0 !== count($selectcards)){
        foreach ($selectcards as $key => $selectcard ) {
            if ($key == 0) {
                $selectcard_1 = $selectcard->card_number;
            } if ($key == 1) {
                $selectcard_2 =$selectcard->card_number;
            } if ($key == 2) {
                $selectcard_3 =$selectcard->card_number;
            }
        }
        $users = User::where('group_id', '1')->get();
        return view('room',compact('users','selectcard_1','selectcard_2','selectcard_3'));
    }
    $users = User::where('group_id', '1')->get();
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
        //
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
        if (DB::table('users')->where('group_id', '1')->count() <= 3) {
            $group = new Group;
            $group->user_id = Auth::id();
            $group->save();

            $user = User::where('id', Auth::id())->first();
            $user->group_id = $request->group;
            $user->update();

            return redirect()->route('groups.index');
        }
        return redirect('/home')->with('message','部屋１は満員です');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
