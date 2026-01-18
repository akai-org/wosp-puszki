<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

/**
 * @property int $id
 * @property string $collectorIdentifier
 * @property int $collector_id
 * @property bool $is_given_to_collector
 * @property int $given_to_collector_user_id
 * @property string $time_given
 * @property bool $is_counted
 * @property int|null $counting_user_id
 * @property string|null $time_counted
 * @property bool $is_confirmed
 * @property int|null $user_confirmed_id
 * @property string|null $time_confirmed
 * @property int $count_1gr
 * @property int $count_2gr
 * @property int $count_5gr
 * @property int $count_10gr
 * @property int $count_20gr
 * @property int $count_50gr
 * @property int $count_1zl
 * @property int $count_2zl
 * @property int $count_5zl
 * @property int $count_10zl
 * @property int $count_20zl
 * @property int $count_50zl
 * @property int $count_100zl
 * @property int $count_200zl
 * @property int $count_500zl
 * @property numeric $amount_PLN
 * @property numeric $amount_EUR
 * @property numeric $amount_USD
 * @property numeric $amount_GBP
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $is_special_box
 * @property string|null $metadata
 * @property string|null $additional_comment
 * @property string|null $first_counted_by_name
 * @property string|null $first_counted_by_phone
 * @property string|null $second_counted_by_name
 * @property string|null $second_counted_by_phone
 * @property-read \App\Collector|null $collector
 * @property-read \App\User|null $countingUser
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\BoxEvent> $events
 * @property-read int|null $events_count
 * @property-read mixed $display_id
 * @property-read mixed $original_counting_user_id
 * @property-read mixed $total_with_foreign
 * @property-read \App\User|null $givenToCollectorUser
 * @property-read \App\User|null $personConfirming
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Venturecraft\Revisionable\Revision> $revisionHistory
 * @property-read int|null $revision_history_count
 * @method static Builder<static>|CharityBox confirmed()
 * @method static Builder<static>|CharityBox newModelQuery()
 * @method static Builder<static>|CharityBox newQuery()
 * @method static Builder<static>|CharityBox notCounted()
 * @method static Builder<static>|CharityBox query()
 * @method static Builder<static>|CharityBox unconfirmed()
 * @method static Builder<static>|CharityBox whereAdditionalComment($value)
 * @method static Builder<static>|CharityBox whereAmountEUR($value)
 * @method static Builder<static>|CharityBox whereAmountGBP($value)
 * @method static Builder<static>|CharityBox whereAmountPLN($value)
 * @method static Builder<static>|CharityBox whereAmountUSD($value)
 * @method static Builder<static>|CharityBox whereCollectorId($value)
 * @method static Builder<static>|CharityBox whereCollectorIdentifier($value)
 * @method static Builder<static>|CharityBox whereComment($value)
 * @method static Builder<static>|CharityBox whereCount100zl($value)
 * @method static Builder<static>|CharityBox whereCount10gr($value)
 * @method static Builder<static>|CharityBox whereCount10zl($value)
 * @method static Builder<static>|CharityBox whereCount1gr($value)
 * @method static Builder<static>|CharityBox whereCount1zl($value)
 * @method static Builder<static>|CharityBox whereCount200zl($value)
 * @method static Builder<static>|CharityBox whereCount20gr($value)
 * @method static Builder<static>|CharityBox whereCount20zl($value)
 * @method static Builder<static>|CharityBox whereCount2gr($value)
 * @method static Builder<static>|CharityBox whereCount2zl($value)
 * @method static Builder<static>|CharityBox whereCount500zl($value)
 * @method static Builder<static>|CharityBox whereCount50gr($value)
 * @method static Builder<static>|CharityBox whereCount50zl($value)
 * @method static Builder<static>|CharityBox whereCount5gr($value)
 * @method static Builder<static>|CharityBox whereCount5zl($value)
 * @method static Builder<static>|CharityBox whereCountingUserId($value)
 * @method static Builder<static>|CharityBox whereCreatedAt($value)
 * @method static Builder<static>|CharityBox whereFirstCountedByName($value)
 * @method static Builder<static>|CharityBox whereFirstCountedByPhone($value)
 * @method static Builder<static>|CharityBox whereGivenToCollectorUserId($value)
 * @method static Builder<static>|CharityBox whereId($value)
 * @method static Builder<static>|CharityBox whereIsConfirmed($value)
 * @method static Builder<static>|CharityBox whereIsCounted($value)
 * @method static Builder<static>|CharityBox whereIsGivenToCollector($value)
 * @method static Builder<static>|CharityBox whereIsSpecialBox($value)
 * @method static Builder<static>|CharityBox whereMetadata($value)
 * @method static Builder<static>|CharityBox whereSecondCountedByName($value)
 * @method static Builder<static>|CharityBox whereSecondCountedByPhone($value)
 * @method static Builder<static>|CharityBox whereTimeConfirmed($value)
 * @method static Builder<static>|CharityBox whereTimeCounted($value)
 * @method static Builder<static>|CharityBox whereTimeGiven($value)
 * @method static Builder<static>|CharityBox whereUpdatedAt($value)
 * @method static Builder<static>|CharityBox whereUserConfirmedId($value)
 * @mixin \Eloquent
 */
class CharityBox extends Model
{
    use RevisionableTrait;

    protected $casts = [
        'is_given_to_collector' => 'boolean',
    ];

    protected $appends = [
        'original_counting_user_id',
    ];

    public function getOriginalCountingUserIdAttribute()
    {
        $history = $this->revisionHistory->where('key', 'counting_user_id')->sortBy('created_at')->first();
        if ($history) {
            return (int)$history->new_value;
        }
        return $this->counting_user_id;
    }

    public function collector()
    {
        return $this->belongsTo('App\Collector');
    }

    public function givenToCollectorUser()
    {
        return $this->belongsTo('App\User', 'given_to_collector_user_id', 'id');
    }

    public function countingUser()
    {
        return $this->belongsTo('App\User', 'counting_user_id', 'id');
    }

    public function personConfirming()
    {
        return $this->belongsTo('App\User', 'user_confirmed_id', 'id');
    }

    public function events()
    {
        return $this->hasMany('App\BoxEvent');
    }

    public function getTotalWithForeignAttribute()
    {
        $totalWithForeign = array_sum([
            $this->amount_PLN,
            $this->amount_EUR * config('rates.eur'),
            $this->amount_GBP * config('rates.gbp'),
            $this->amount_USD * config('rates.usd')
        ]);
        return number_format($totalWithForeign, 2, ',', ' ');
    }

    public function getDisplayIdAttribute()
    {
        return ' (ID puszki w bazie: ' . $this->id . ')';
    }

    public function scopeNotCounted(Builder $query): Builder
    {
        return $query
            ->where('is_given_to_collector', '=', true)
            ->where('is_counted', '=', false)
            ->where('is_confirmed', '=', false);
    }

    public function scopeUnconfirmed(Builder $query): Builder
    {
        return $query
            ->where('is_given_to_collector', '=', true)
            ->where('is_counted', '=', true)
            ->where('is_confirmed', '=', false);
    }

    public function scopeConfirmed(Builder $query): Builder
    {
        return $query
            ->where('is_given_to_collector', '=', true)
            ->where('is_counted', '=', true)
            ->where('is_confirmed', '=', true);
    }
}
