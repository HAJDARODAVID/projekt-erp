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
        Schema::create('cooperator_workers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cooperator_id')->unsigned();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->timestamps();

            $table->foreign('cooperator_id')->references('id')->on('cooperators');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooperator_workers');
    }
};
