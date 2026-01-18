<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

/**
 * @property int $id
 * @property string $type
 * @property int $box_id
 * @property int $user_id
 * @property string $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\CharityBox|null $box
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Venturecraft\Revisionable\Revision> $revisionHistory
 * @property-read int|null $revision_history_count
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoxEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoxEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoxEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoxEvent whereBoxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoxEvent whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoxEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoxEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoxEvent whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoxEvent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoxEvent whereUserId($value)
 * @mixin \Eloquent
 */
class BoxEvent extends Model
{
    use RevisionableTrait;
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function box() {
        return $this->belongsTo('App\CharityBox');
    }
}
