<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

/**
 * @property string $id
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppStatus whereValue($value)
 * @mixin \Eloquent
 */
class AppStatus extends Model
{
    use RevisionableTrait {
        // Define original 'getSystemUserId' as alias.
        RevisionableTrait::getSystemUserId as traitGetSystemUserId;
    }

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'value'];

    //https://github.com/VentureCraft/revisionable/issues/295
    // @phpstan-ignore method.unused
    private function getSystemUserId()
    {
        Log:
        info('getSystemUserId called');
        $user_id = $this->traitGetSystemUserId();

        if (is_null($user_id)) {
            $user_id = 1;
        }

        return $user_id;
    }

    public static function boot()
    {
        parent::boot();
    }
}
