<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Venturecraft\Revisionable\Revision;
use Venturecraft\Revisionable\RevisionableTrait;

/**
 * @property int $id
 * @property string $type
 * @property int $box_id
 * @property int $user_id
 * @property string $comment
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read CharityBox|null $box
 * @property-read Collection<int, Revision> $revisionHistory
 * @property-read int|null $revision_history_count
 * @property-read User|null $user
 * @method static Builder<static>|BoxEvent newModelQuery()
 * @method static Builder<static>|BoxEvent newQuery()
 * @method static Builder<static>|BoxEvent query()
 * @method static Builder<static>|BoxEvent whereBoxId($value)
 * @method static Builder<static>|BoxEvent whereComment($value)
 * @method static Builder<static>|BoxEvent whereCreatedAt($value)
 * @method static Builder<static>|BoxEvent whereId($value)
 * @method static Builder<static>|BoxEvent whereType($value)
 * @method static Builder<static>|BoxEvent whereUpdatedAt($value)
 * @method static Builder<static>|BoxEvent whereUserId($value)
 * @mixin Eloquent
 */
class BoxEvent extends Model
{
    use RevisionableTrait;

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<CharityBox, $this>
     */
    public function box(): BelongsTo
    {
        return $this->belongsTo(CharityBox::class);
    }
}
