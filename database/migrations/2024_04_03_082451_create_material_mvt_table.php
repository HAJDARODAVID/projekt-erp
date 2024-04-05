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
        Schema::create('material_mvt', function (Blueprint $table) {
            $table->id();
            $table->integer('stg_loc')->nullable();
            $table->unsignedBigInteger('const_id')->unsigned()->nullable();
            $table->integer('mvt')->nullable();
            $table->unsignedBigInteger('mat_doc_id')->unsigned()->nullable();
            $table->unsignedBigInteger('mat_id')->unsigned()->nullable();
            $table->bigInteger('qty')->nullable();
            $table->timestamps();

            $table->foreign('const_id')->references('id')->on('construction_sites')->noActionOnDelete();
            $table->foreign('mat_doc_id')->references('id')->on('material_doc')->cascadeOnDelete();
            $table->foreign('mat_id')->references('id')->on('mm')->noActionOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_mvt');
    }
};
