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
        Schema::create('payroll_basic_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('worker_id')->unsigned();
            $table->float('h_rate')->nullable();
            $table->float('fix_rate')->nullable();
            $table->float('travel_exp')->nullable();
            $table->float('phone_exp')->nullable();
            $table->timestamps();

            $table->foreign('worker_id')->references('id')->on('workers')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_baic_info');
    }
};
