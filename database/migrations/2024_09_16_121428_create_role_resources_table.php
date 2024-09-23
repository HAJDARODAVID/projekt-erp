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
        Schema::create('role_resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')->unsigned();
            $table->unsignedBigInteger('resources_id')->unsigned();

            $table->foreign('role_id')->references('id')->on('role_groups')->cascadeOnDelete();
            $table->foreign('resources_id')->references('id')->on('resources')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_resources');
    }
};