<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CharityBox extends Model
{
    protected $casts = [
        'is_given_to_collector' => 'boolean',
    ];

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
        return $this->belongsTo('App\User','user_confirmed_id','id');
    }

    public function events() {
        return $this->hasMany('App\BoxEvent');
    }

    public function getTotalWithForeignAttribute() {
        $totalWithForeign = array_sum([
                $this->amount_PLN,
                $this->amount_EUR * config('rates.eur'),
                $this->amount_GBP * config('rates.gbp'),
                $this->amount_USD * config('rates.usd')
        ]);
        return number_format($totalWithForeign, 2, ',', ' ');
    }

    public function getDisplayIdAttribute() {
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
