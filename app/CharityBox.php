<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharityBox extends Model
{
    /**
     * Get the post that owns the comment.
     */
    public function collector()
    {
        return $this->belongsTo('App\Collector');
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
}
