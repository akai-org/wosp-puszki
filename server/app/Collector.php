<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

/**
 * @property int $id
 * @property string $identifier
 * @property string $firstName
 * @property string $lastName
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $phoneNumber
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\CharityBox> $boxes
 * @property-read int|null $boxes_count
 * @property-read mixed $display
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Venturecraft\Revisionable\Revision> $revisionHistory
 * @property-read int|null $revision_history_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collector newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collector newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collector query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collector whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collector whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collector whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collector whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collector whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collector wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collector whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Collector extends Model
{
    use RevisionableTrait;
    public function show()
    {
        $formatted = $this->firstName . ' ';
        $formatted .= $this->lastName . ' ';
        $formatted .= $this->phoneNumber . ' ';
        $formatted .= "($this->identifier)";
        return $formatted;
    }

    public function boxes()
    {
        return $this->hasMany('App\CharityBox');
    }

    public function getDisplayAttribute() {
        $formatted = $this->firstName . ' ';
        $formatted .= $this->lastName . ' ';
        $formatted .= "($this->identifier)";
        return $formatted;
    }
}
