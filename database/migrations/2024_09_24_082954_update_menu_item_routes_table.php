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
        Schema::table('module_item_routes', function (Blueprint $table) {
            $table->unsignedBigInteger('resource_id')->unsigned()->after('module_id')->nullable();

            $table->foreign('resource_id')->references('id')->on('resources')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('module_item_routes', function (Blueprint $table) {
            //
        });
    }
};
