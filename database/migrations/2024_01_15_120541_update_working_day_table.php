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
        Schema::table('working_day_record',function($table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('construction_site_id')->references('id')->on('construction_sites');
            $table->foreign('car_id')->references('id')->on('company_cars');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
