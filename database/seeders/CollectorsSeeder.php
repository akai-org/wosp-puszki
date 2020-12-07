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
        //Narzędzie do generowania losowych danych

        $faker = \Faker\Factory::create('pl_PL');

        //Tworzymy 1000 wolontariuszy
        for($i=0;$i<500;$i++) {
            $collector = new Collector();
            $collector->firstName = $faker->firstName;
            $collector->lastName = $faker->lastName;
            $collector->identifier = $faker->unique()->numberBetween(1,900); //nr wolontariusza/numer sztabu
            $collector->save();
        }

    }
}
