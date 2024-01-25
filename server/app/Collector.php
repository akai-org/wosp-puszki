<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collector extends Model
{
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
