<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Killcard extends Model
{
    public function group()
    {
        return $this->hasOne('App\Group');
    }
}
