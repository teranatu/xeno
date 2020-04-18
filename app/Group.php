<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function cards()
    {
        return $this->hasMany('App\Card');
    }
    public function deadcards()
    {
        return $this->hasMany('App\Deadcard');
    }
    public function killcard()
    {
        return $this->hasOne('App\Killcard');
    }
    public function users()
    {
        return $this->hasMany('App\User');
    }
    public function scopeGroupWithUsersCardsDeadCardsKillCard($query,$group) {
        $query->where('id',$group->id)->with('users','cards','deadcards','killcard');
    }
}
