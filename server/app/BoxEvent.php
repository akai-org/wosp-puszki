<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoxEvent extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function box() {
        return $this->belongsTo('App\CharityBox');
    }
}
