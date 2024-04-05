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
        Schema::table('mm', function (Blueprint $table) {
            $table->unsignedBigInteger('supplier_id')->unsigned()->nullable()->after('oem');
            $table->dropColumn('supplier');

            $table->foreign('supplier_id')->references('id')->on('suppliers')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mm', function (Blueprint $table) {
            //
        });
    }
};
