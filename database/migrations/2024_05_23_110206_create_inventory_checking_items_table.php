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
        Schema::create('inventory_checking_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inv_id')->unsigned();
            $table->unsignedBigInteger('mat_id')->unsigned();
            $table->bigInteger('qty');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->bigInteger('str_loc')->nullable();
            $table->unsignedBigInteger('cons_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('inv_id')->references('id')->on('inventory_checking')->cascadeOnDelete();
            $table->foreign('mat_id')->references('id')->on('mm')->noActionOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->noActionOnDelete();
            $table->foreign('cons_id')->references('id')->on('construction_sites')->noActionOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_checking_items');
    }
};
