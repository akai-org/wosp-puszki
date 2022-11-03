<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBoxMetaColumnToCharityBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('charity_boxes', function (Blueprint $table) {
            $table->addColumn('boolean', 'is_special_box')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('charity_boxes', function (Blueprint $table) {
            $table->dropColumn('is_special_box');
        });
    }
}
