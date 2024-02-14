<?php

use Illuminate\Support\Facades\DB;
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
        DB::statement("
            CREATE VIEW work_day_diary_view AS
            (
                SELECT 
                    wdr.id,
                    wdr.user_id,
                    usr.worker_id,
                    wrk.firstName,
                    wrk.lastName,
                    wdr.construction_site_id,
                    cs.name,
                    wdr.date,
                    wdr.work_type,
                    cc.car_plates
                FROM `working_day_record` as wdr
                LEFT JOIN `users` as usr
                ON wdr.user_id = usr.id
                LEFT JOIN `construction_sites` as cs
                ON wdr.construction_site_id = cs.id
                LEFT JOIN `company_cars` as cc
                ON wdr.car_id = cc.id
                LEFT JOIN `workers` as wrk
                ON usr.worker_id = wrk.id
            )
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_day_diary_view');
    }
};
