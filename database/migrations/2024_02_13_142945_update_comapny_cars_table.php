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
        Schema::table('company_cars', function (Blueprint $table) {
            $table->bigInteger('service_every')->nullable()->after('avatar');
            $table->bigInteger('last_service_at')->nullable()->after('avatar');    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_cars', function (Blueprint $table) {
            $table->dropColumn('service_every');
            $table->dropColumn('last_service_at');
        });
    }
};
