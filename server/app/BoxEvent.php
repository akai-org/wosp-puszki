<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class BoxEvent extends Model
{
    use RevisionableTrait;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function box()
    {
        return $this->belongsTo('App\CharityBox');
    }
}
