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
        Schema::create('mat_cons_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mat_cons_id')->unsigned();
            $table->bigInteger('mat_id');
            $table->bigInteger('qty');
            $table->timestamps();

            $table->foreign('mat_cons_id')->references('id')->on('mat_cons')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mat_cons_items');
    }
};
