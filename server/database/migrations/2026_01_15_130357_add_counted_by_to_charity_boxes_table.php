<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('charity_boxes', function (Blueprint $table) {
            $table->addColumn('string', 'first_counted_by_name', ['length' => 255])->nullable();
            $table->addColumn('string', 'first_counted_by_phone', ['length' => 12])->nullable();
            $table->addColumn('string', 'second_counted_by_name', ['length' => 255])->nullable();
            $table->addColumn('string', 'second_counted_by_phone', ['length' => 12])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('charity_boxes', function (Blueprint $table) {
            //
        });
    }
};
