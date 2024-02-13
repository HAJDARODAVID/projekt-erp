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
        Schema::create('company_cars_mileage', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id')->unsigned()->nullable();
            $table->unsignedBigInteger('wdr_id')->unsigned()->nullable();
            $table->bigInteger('start_mileage')->nullable();
            $table->bigInteger('end_mileage')->nullable();
            $table->timestamps();

            $table->foreign('car_id')->references('id')->on('company_cars')->cascadeOnDelete();
            $table->foreign('wdr_id')->references('id')->on('working_day_record')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_cars_mileage');
    }
};
