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
        Schema::table('workers', function($table){
            $table->date('doe')->nullable()->after('employed')->comment('Date of employment');
            $table->string('working_place')->nullable()->after('employed');
            $table->bigInteger('OIB')->nullable()->after('employed');
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
