<?php

use Illuminate\Database\Seeder;
use App\CharityBox;
use App\Collector;
use Money\Money;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;

class CharityBoxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        //Dodajemy 2000 losowych puszek, do testowania
        for($i=0;$i<2000;$i++) {
            $charityBox = new CharityBox();
            $collector = Collector::inRandomOrder()->first();
            $charityBox->collectorIdentifier = $collector->identifier;
            $charityBox->collector_id = $collector->id;
            $charityBox->is_given_to_collector = true;
            $charityBox->given_to_collector_user_id = 1;

            $rand = rand(0,100);

            //30% puszek pustych generujemy
            if($rand >= 70) {
                $charityBox->is_counted = false;
            } else {
                // 70% pełnych
                $charityBox->is_counted = true;
                $charityBox->counting_user_id = 2;
                if($rand >= 50) {
                    //20% pełnych puszek, niepotwierdzonych
                    $charityBox->is_confirmed = false;
                } else {
                    //Reszta (50%) pełna i potwierdzona
                    $charityBox->is_confirmed = true;
                    $charityBox->user_confirmed_id = 1;
                }

                //Wypełniamy hajsem
                $charityBox->count_1gr = $faker->numberBetween(0,3000);
                $charityBox->count_2gr = $faker->numberBetween(0,2000);
                $charityBox->count_5gr = $faker->numberBetween(0,1000);
                $charityBox->count_10gr = $faker->numberBetween(0,500);
                $charityBox->count_20gr = $faker->numberBetween(0,200);
                $charityBox->count_50gr = $faker->numberBetween(0,100);
                $charityBox->count_1zl = $faker->numberBetween(0,100);
                $charityBox->count_2zl = $faker->numberBetween(2,100);
                $charityBox->count_5zl = $faker->numberBetween(2,100);
                $charityBox->count_10zl = $faker->numberBetween(2,50);
                $charityBox->count_20zl = $faker->numberBetween(2,20);
                $charityBox->count_50zl = $faker->numberBetween(0,20);
                $charityBox->count_100zl = $faker->numberBetween(0,10);
                $charityBox->count_200zl = $faker->numberBetween(0,5);
                $charityBox->count_500zl = $faker->numberBetween(0,1);

                //Przeliczamy sumę hajsu
                //Ilości są w groszach
                $total = Money::PLN(0);
                $total = $total->add(Money::PLN($charityBox->count_1gr));
                $total = $total->add(Money::PLN($charityBox->count_2gr * 2));
                $total = $total->add(Money::PLN($charityBox->count_5gr * 5));
                $total = $total->add(Money::PLN($charityBox->count_10gr * 10));
                $total = $total->add(Money::PLN($charityBox->count_20gr * 20));
                $total = $total->add(Money::PLN($charityBox->count_50gr * 50));
                $total = $total->add(Money::PLN($charityBox->count_1zl * 100));//1zł=100gr
                $total = $total->add(Money::PLN($charityBox->count_2zl * 200));
                $total = $total->add(Money::PLN($charityBox->count_5zl * 500));
                $total = $total->add(Money::PLN($charityBox->count_10zl * 1000));
                $total = $total->add(Money::PLN($charityBox->count_20zl * 2000));
                $total = $total->add(Money::PLN($charityBox->count_50zl * 5000));
                $total = $total->add(Money::PLN($charityBox->count_100zl * 10000));
                $total = $total->add(Money::PLN($charityBox->count_200zl * 20000));
                $total = $total->add(Money::PLN($charityBox->count_500zl * 50000));

                //Formatowanie
                $currencies = new ISOCurrencies();

                $moneyFormatter = new DecimalMoneyFormatter($currencies);

                $charityBox->amount_PLN = $moneyFormatter->format($total); // outputs 1.00 (decimal)

                //Inne waluty
                //USD
                $charityBox->amount_USD = $faker->randomFloat(2, 0, 5);
                //EUR
                $charityBox->amount_EUR = $faker->randomFloat(2, 0, 5);
                //GBP
                $charityBox->amount_GBP = $faker->randomFloat(2, 0, 5);
            }

            //Komentarz
            $charityBox->comment = 'Puszka nr ' . $i;

            $charityBox->save();
        }

    }
}
