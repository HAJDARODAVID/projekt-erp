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
        Schema::create('int_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('const_id')->unsigned();
            $table->unsignedBigInteger('ordered_by')->unsigned();
            $table->integer('status')->default(1);
            $table->string('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('int_orders');
    }
};
