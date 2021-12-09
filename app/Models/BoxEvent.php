<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoxEvent extends Model
{
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function box() {
        return $this->belongsTo('App\Models\CharityBox');
    }
}
