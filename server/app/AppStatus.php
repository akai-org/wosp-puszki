<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class AppStatus extends Model
{
//    use \Venturecraft\Revisionable\RevisionableTrait {
//         Define original 'getSystemUserId' as alias.
//        RevisionableTrait::getSystemUserId as traitGetSystemUserId;
//    }
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [ 'id', 'value' ];

    //https://github.com/VentureCraft/revisionable/issues/295
    private function getSystemUserId()
    {
        Log:info('getSystemUserId called');
        $user_id = $this->traitGetSystemUserId();

        if(is_null($user_id)) {
            $user_id = 1;
        }

        return $user_id;
    }

    public static function boot()
    {
        parent::boot();
    }
}
