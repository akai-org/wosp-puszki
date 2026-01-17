<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Venturecraft\Revisionable\RevisionableTrait;

/**
 * @property string $id
 * @property string $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|AppStatus newModelQuery()
 * @method static Builder<static>|AppStatus newQuery()
 * @method static Builder<static>|AppStatus query()
 * @method static Builder<static>|AppStatus whereCreatedAt($value)
 * @method static Builder<static>|AppStatus whereId($value)
 * @method static Builder<static>|AppStatus whereUpdatedAt($value)
 * @method static Builder<static>|AppStatus whereValue($value)
 * @mixin Eloquent
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

    public static function boot()
    {
        parent::boot();
    }

    private function getSystemUserId(): int
    {
        Log:
        info('getSystemUserId called');
        $user_id = $this->traitGetSystemUserId();

        if (is_null($user_id)) {
            $user_id = 1;
        }

        return $user_id;
    }
}
