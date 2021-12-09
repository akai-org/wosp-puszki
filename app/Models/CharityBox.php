<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharityBox extends Model
{
    /**
     * Get the post that owns the comment.
     */
    public function collector()
    {
        return $this->belongsTo('App\Models\Collector');
    }

    public function personConfirming()
    {
        return $this->belongsTo('App\Models\User','user_confirmed_id','id');
    }

    public function events() {
        return $this->hasMany('App\Models\BoxEvent');
    }

    public function getTotalWithForeignAttribute() {
        $totalWithForeign = array_sum([
                $this->amount_PLN,
                $this->amount_EUR * env('RATE_EUR'),
                $this->amount_GBP * env('RATE_GBP'),
                $this->amount_USD * env('RATE_USD')
        ]);
        return number_format($totalWithForeign, 2, ',', ' ');
    }

    public function getDisplayIdAttribute() {
        return ' (ID puszki w bazie: ' . $this->id . ')';
    }
}
