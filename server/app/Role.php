<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Role extends Model
{
    use RevisionableTrait;
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
