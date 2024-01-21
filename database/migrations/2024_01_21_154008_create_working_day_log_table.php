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
        Schema::create('working_day_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('working_day_record_id')->unsigned()->nullable();
            $table->unsignedBigInteger('construction_site_id')->unsigned()->nullable();
            $table->string('log')->nullable();
            $table->timestamps();

            $table->foreign('working_day_record_id')->references('id')->on('working_day_record');
            $table->foreign('construction_site_id')->references('id')->on('construction_sites');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working_day_log');
    }
};
