<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharityBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charity_boxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            // Numer kolejny puszki
            // $table->integer('boxNumber');
            // Numer puszki ma format numer wolontariusza/numer sztabu
            // Więc boxNumber nie jets potrzebny
            // Identyfikator wolontariusza
            $table->string('collectorIdentifier');
            // ID wolontariusza w bazie
            $table->bigInteger('collector_id');
            // STATUSY
            // Czy puszka została wydana
            $table->boolean('is_given_to_collector')->default(false);
            // Kto wydał puszkę
            $table->bigInteger('given_to_collector_user_id');
            // Data i godzina wydania puszki
            $table->dateTime('time_given');
            // Czy puszka została policzona
            $table->boolean('is_counted')->default(false);
            // Użytkownik rozliczający puszkę
            $table->bigInteger('counting_user_id')->nullable();
            // Data i godzina przeliczenia puszki
            $table->dateTime('time_counted')->nullable();
            // Czy puszka została zatwierdzona
            $table->boolean('is_confirmed')->default(false);
            // Kto zatwierdził
            $table->bigInteger('user_confirmed_id')->nullable();
            // Czas zatwierdzenia puszki
            $table->dateTime('time_confirmed')->nullable();
            // Ilość monet 1gr
            $table->integer('count_1gr')->default(0);
            // Ilość monet 2gr
            $table->integer('count_2gr')->default(0);
            // Ilość monet 5gr
            $table->integer('count_5gr')->default(0);
            // Ilość monet 10gr
            $table->integer('count_10gr')->default(0);
            // Ilość monet 20gr
            $table->integer('count_20gr')->default(0);
            // Ilość monet 50gr
            $table->integer('count_50gr')->default(0);
            // Ilość monet 1zł
            $table->integer('count_1zl')->default(0);
            // Ilość monet 2zł
            $table->integer('count_2zl')->default(0);
            // Ilość monet 5zł
            $table->integer('count_5zl')->default(0);
            // Ilość banknotów 10zł
            $table->integer('count_10zl')->default(0);
            // Ilość banknotów 20zł
            $table->integer('count_20zl')->default(0);
            // Ilość banknotów 50zł
            $table->integer('count_50zl')->default(0);
            // Ilość banknotów 100zł
            $table->integer('count_100zl')->default(0);
            // Ilość banknotów 200zł
            $table->integer('count_200zl')->default(0);
            // Ilość banknotów 500zł
            $table->integer('count_500zl')->default(0);
            // Suma PLN po przeliczeniu
            $table->decimal('amount_PLN', 12, 2)->default(0);
            // Inne waluty
            // Zapisujemy jako wartość, a nie ilość monet
            // EUR
            $table->decimal('amount_EUR', 12, 2)->default(0);
            // USD
            $table->decimal('amount_USD', 12, 2)->default(0);
            // GBP
            $table->decimal('amount_GBP', 12, 2)->default(0);
            // Komentarz
            $table->string('comment')->default('')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charity_boxes');
    }
}
