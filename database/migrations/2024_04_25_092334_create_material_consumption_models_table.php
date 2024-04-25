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
        Schema::create('mat_cons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wdr_id')->unsigned();
            $table->integer('booked');
            $table->timestamps();

            $table->foreign('wdr_id')->references('id')->on('working_day_record')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mat_cons');
    }
};
