<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Venturecraft\Revisionable\Revision;
use Venturecraft\Revisionable\RevisionableTrait;

/**
 * @property int $id
 * @property string $identifier
 * @property string $firstName
 * @property string $lastName
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $phoneNumber
 * @property-read Collection<int, CharityBox> $boxes
 * @property-read int|null $boxes_count
 * @property-read mixed $display
 * @property-read Collection<int, Revision> $revisionHistory
 * @property-read int|null $revision_history_count
 * @method static Builder<static>|Collector newModelQuery()
 * @method static Builder<static>|Collector newQuery()
 * @method static Builder<static>|Collector query()
 * @method static Builder<static>|Collector whereCreatedAt($value)
 * @method static Builder<static>|Collector whereFirstName($value)
 * @method static Builder<static>|Collector whereId($value)
 * @method static Builder<static>|Collector whereIdentifier($value)
 * @method static Builder<static>|Collector whereLastName($value)
 * @method static Builder<static>|Collector wherePhoneNumber($value)
 * @method static Builder<static>|Collector whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Collector extends Model
{
    use RevisionableTrait;

    public function show(): string
    {
        $formatted = $this->firstName . ' ';
        $formatted .= $this->lastName . ' ';
        $formatted .= $this->phoneNumber . ' ';
        $formatted .= "($this->identifier)";
        return $formatted;
    }

    /**
     * @return HasMany<CharityBox, $this>
     */
    public function boxes(): HasMany
    {
        return $this->hasMany(CharityBox::class);
    }

    public function getDisplayAttribute(): string
    {
        $formatted = $this->firstName . ' ';
        $formatted .= $this->lastName . ' ';
        $formatted .= "($this->identifier)";
        return $formatted;
    }
}
