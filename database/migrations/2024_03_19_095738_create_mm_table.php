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
        Schema::create('mm', function (Blueprint $table) {
            $table->id()->from(500000);
            $table->string('mm_uid')->nullable();
            $table->string('name')->nullable();
            $table->string('oem')->nullable();
            $table->string('supplier')->nullable();
            $table->string('uom_1')->nullable();
            $table->float('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mm');
    }
};
