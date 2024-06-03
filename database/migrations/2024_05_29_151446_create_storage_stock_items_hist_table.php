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
        Schema::create('storage_stock_items_hist', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inv_id')->unsigned()->nullable();
            $table->unsignedBigInteger('mat_id')->unsigned()->nullable();
            $table->integer('str_loc')->nullable();
            $table->bigInteger('cons_id')->nullable();
            $table->bigInteger('qty')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storage_stock_items_hist');
    }
};
