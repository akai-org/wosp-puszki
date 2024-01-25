<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class AppStatus extends Model
{
    use RevisionableTrait;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [ 'id', 'value' ];
}
