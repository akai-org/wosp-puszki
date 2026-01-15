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
            $table->addColumn('string', 'additional_comment')->default('')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('charity_boxes', function (Blueprint $table) {
            $table->dropColumn('additional_comment');
        });
    }
};
