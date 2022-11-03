<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Collector;

class CollectorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Tworzymy 1000 wolontariuszy
        for($i=0;$i<500;$i++) {
            $collector = new Collector();
            $collector->firstName = 'imie_' . $i;
            $collector->lastName = 'nazwisko_' . $i;
            $collector->identifier = $i; //nr wolontariusza/numer sztabu
            $collector->save();
        }

    }
}
