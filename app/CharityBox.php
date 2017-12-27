<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharityBox extends Model
{
    /**
     * Get the post that owns the comment.
     */
    public function collector()
    {
        return $this->belongsTo('App\Collector');
    }
}
