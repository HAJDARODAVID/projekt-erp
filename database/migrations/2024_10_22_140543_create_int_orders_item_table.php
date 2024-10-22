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
        Schema::create('int_orders_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ord_id')->unsigned();
            $table->unsignedBigInteger('mat_id')->unsigned();
            $table->float('qty');

            $table->foreign('ord_id')->references('id')->on('int_orders')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('int_orders_items');
    }
};
