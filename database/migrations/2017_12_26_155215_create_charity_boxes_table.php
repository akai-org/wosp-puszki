<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            //Numer kolejny puszki
            $table->integer('boxNumber');
            //Identyfikator wolontariusza
            $table->string('collectorIdentifier');
            //ID wolontariusza w bazie
            $table->integer('collector_id');
            //STATUSY
            //Czy puszka została wydana
            $table->boolean('is_given_to_collector')->default(false);
            //Kto wydał puszkę
            $table->integer('given_to_collector_user_id');
            //Czy puszka została policzona
            $table->boolean('is_counted')->default(false);
            //Użytkownik rozliczający puszkę
            $table->integer('counting_user_id')->nullable();
            //Czy puszka została zatwierdzona
            $table->boolean('is_confirmed')->default(false);
            //Kto zatwierdził
            $table->integer('user_confirmed_id')->nullable();
            //Ilość monet 1gr
            $table->integer('count_1gr')->default(0);
            //Ilość monet 2gr
            $table->integer('count_2gr')->default(0);
            //Ilość monet 5gr
            $table->integer('count_5gr')->default(0);
            //Ilość monet 10gr
            $table->integer('count_10gr')->default(0);
            //Ilość monet 20gr
            $table->integer('count_20gr')->default(0);
            //Ilość monet 50gr
            $table->integer('count_50gr')->default(0);
            //Ilość monet 1zł
            $table->integer('count_1zl')->default(0);
            //Ilość monet 2zł
            $table->integer('count_2zl')->default(0);
            //Ilość monet 5zł
            $table->integer('count_5zl')->default(0);
            //Ilość banknotów 10zł
            $table->integer('count_10zl')->default(0);
            //Ilość banknotów 20zł
            $table->integer('count_20zl')->default(0);
            //Ilość banknotów 50zł
            $table->integer('count_50zl')->default(0);
            //Ilość banknotów 100zł
            $table->integer('count_100zl')->default(0);
            //Ilość banknotów 200zł
            $table->integer('count_200zl')->default(0);
            //Ilość banknotów 500zł
            $table->integer('count_500zl')->default(0);
            //Suma PLN po przeliczeniu
            $table->decimal('amount_PLN',12,2)->default(0);
            //Inne waluty
            //Zapisujemy jako wartość, a nie ilość monet
            //EUR
            $table->decimal('amount_EUR',12,2)->default(0);
            //USD
            $table->decimal('amount_USD',12,2)->default(0);
            //GBP
            $table->decimal('amount_GBP',12,2)->default(0);
            //Komentarz
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
