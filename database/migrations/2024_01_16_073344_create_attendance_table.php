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
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('worker_id')->unsigned();
            $table->unsignedBigInteger('working_day_record_id')->unsigned();
            $table->integer('work hours');
            $table->integer('type');
            $table->date('date');
            $table->timestamps();

            $table->foreign('worker_id')->references('id')->on('workers');
            $table->foreign('working_day_record_id')->references('id')->on('working_day_record');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
