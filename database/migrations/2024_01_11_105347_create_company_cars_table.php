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
        Schema::create('company_cars', function (Blueprint $table) {
            $table->id();
            $table->string('car_plates')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->date('dop')->nullable()->comment('date of production');
            $table->date('valid_to')->nullable();
            $table->double('purchase_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_cars');
    }
};
