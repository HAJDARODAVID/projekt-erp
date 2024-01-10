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
        Schema::create('worker_address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('worker_id')->unsigned();
            $table->string('street');
            $table->string('town');
            $table->integer('zip');
            $table->string('county');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worker_address');
    }
};
