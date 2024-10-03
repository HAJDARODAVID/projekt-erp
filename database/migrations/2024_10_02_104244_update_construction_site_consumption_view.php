<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW construction_site_consumption_view AS
            (
                SELECT 
                    wdr.construction_site_id as const_site_id, 
                    wdr.id as wdr_id,
                    mci.mat_id, 
                    mm.name, 
                    mci.qty, 
                    mm.uom_1, 
                    mci.qty * mm.price as amount, 
                    mc.updated_at as consumption_date
                FROM `mat_cons_items` AS mci
                LEFT JOIN `mat_cons` AS mc ON mci.mat_cons_id = mc.id
                LEFT JOIN `working_day_record` AS wdr ON mc.wdr_id = wdr.id
                LEFT JOIN `mm` AS mm ON mci.mat_id = mm.id
                WHERE mc.booked = 1
            )
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('construction_site_consumption_view');
    }
};
