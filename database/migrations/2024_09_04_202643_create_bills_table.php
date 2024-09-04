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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id')->unsigned();
            $table->unsignedBigInteger('categories_id')->unsigned();
            $table->float('amount');
            $table->date('date');
            $table->timestamps();

            $table->foreign('provider_id')->references('id')->on('bill_providers')->noActionOnDelete();
            $table->foreign('categories_id')->references('id')->on('bill_categories')->noActionOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
