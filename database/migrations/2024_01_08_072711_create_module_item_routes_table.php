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
        Schema::create('module_item_routes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('route_name');
            $table->unsignedBigInteger('module_id');

            $table->foreign('module_id')->references('id')->on('module_items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_item_routes');
    }
};
