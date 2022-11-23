<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppStatus extends Model
{

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [ 'id', 'value' ];
}
