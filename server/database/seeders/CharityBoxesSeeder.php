<?php

namespace Database\Seeders;

use App\CharityBox;
use App\Collector;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;

class CharityBoxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $boxCount = 20;
        // Dodajemy 2000 losowych puszek, do testowania
        for ($i = 0; $i < $boxCount; $i++) {
            $charityBox = new CharityBox;
            $collector = Collector::inRandomOrder()->first();
            $charityBox->collectorIdentifier = $collector->identifier;
            $charityBox->collector_id = $collector->id;
            $charityBox->is_given_to_collector = true;
            $charityBox->given_to_collector_user_id = 1;
            $charityBox->time_given =
                Carbon::now()
                    ->subHours(rand(0, 20))
                    ->subMinutes(rand(0, 60))
                    ->subSeconds(rand(0, 60))
                    ->format('Y-m-d H:i:s');

            $rand = rand(0, 100);

            // 30% puszek pustych generujemy
            if ($rand >= 70) {
                $charityBox->is_counted = false;
            } else {
                // 70% pełnych
                $charityBox->is_counted = true;
                $charityBox->counting_user_id = 2;
                $charityBox->time_counted =
                    Carbon::now()
                        ->subHours(rand(0, 20))
                        ->subMinutes(rand(0, 60))
                        ->subSeconds(rand(0, 60))
                        ->format('Y-m-d H:i:s');

                if ($rand >= 50) {
                    // 20% pełnych puszek, niepotwierdzonych
                    $charityBox->is_confirmed = false;
                } else {
                    // Reszta (50%) pełna i potwierdzona
                    $charityBox->is_confirmed = true;
                    $charityBox->user_confirmed_id = 1;
                    $charityBox->time_confirmed =
                        Carbon::now()
                            ->subHours(rand(0, 20))
                            ->subMinutes(rand(0, 60))
                            ->subSeconds(rand(0, 60))
                            ->format('Y-m-d H:i:s');
                }

                // Wypełniamy hajsem
                $charityBox->count_1gr = rand(0, 3000);
                $charityBox->count_2gr = rand(0, 2000);
                $charityBox->count_5gr = rand(0, 1000);
                $charityBox->count_10gr = rand(0, 500);
                $charityBox->count_20gr = rand(0, 200);
                $charityBox->count_50gr = rand(0, 100);
                $charityBox->count_1zl = rand(0, 100);
                $charityBox->count_2zl = rand(2, 100);
                $charityBox->count_5zl = rand(2, 100);
                $charityBox->count_10zl = rand(2, 50);
                $charityBox->count_20zl = rand(2, 20);
                $charityBox->count_50zl = rand(0, 20);
                $charityBox->count_100zl = rand(0, 10);
                $charityBox->count_200zl = rand(0, 5);
                $charityBox->count_500zl = rand(0, 1);

                // Przeliczamy sumę hajsu
                // Ilości są w groszach
                $total = Money::PLN(0);
                $total = $total->add(Money::PLN($charityBox->count_1gr));
                $total = $total->add(Money::PLN($charityBox->count_2gr * 2));
                $total = $total->add(Money::PLN($charityBox->count_5gr * 5));
                $total = $total->add(Money::PLN($charityBox->count_10gr * 10));
                $total = $total->add(Money::PLN($charityBox->count_20gr * 20));
                $total = $total->add(Money::PLN($charityBox->count_50gr * 50));
                $total = $total->add(Money::PLN($charityBox->count_1zl * 100)); // 1zł=100gr
                $total = $total->add(Money::PLN($charityBox->count_2zl * 200));
                $total = $total->add(Money::PLN($charityBox->count_5zl * 500));
                $total = $total->add(Money::PLN($charityBox->count_10zl * 1000));
                $total = $total->add(Money::PLN($charityBox->count_20zl * 2000));
                $total = $total->add(Money::PLN($charityBox->count_50zl * 5000));
                $total = $total->add(Money::PLN($charityBox->count_100zl * 10000));
                $total = $total->add(Money::PLN($charityBox->count_200zl * 20000));
                $total = $total->add(Money::PLN($charityBox->count_500zl * 50000));

                // Formatowanie
                $currencies = new ISOCurrencies;

                $moneyFormatter = new DecimalMoneyFormatter($currencies);

                $charityBox->amount_PLN = $moneyFormatter->format($total); // outputs 1.00 (decimal)

                // Inne waluty
                // USD
                $charityBox->amount_USD = rand(0, 500) / 100;
                // EUR
                $charityBox->amount_EUR = rand(0, 500) / 100;
                // GBP
                $charityBox->amount_GBP = rand(0, 500) / 100;
            }

            // Komentarz
            $charityBox->comment = 'Puszka nr '.$i;
            $charityBox->additional_comment = 'Uwaga '.$i;

            $charityBox->save();
        }

    }
}
