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
            CREATE VIEW available_materials_view AS
            (
                SELECT 
                    ssi.id AS id, 
                    ssi.mat_id AS mat_id,
                    mm.name AS name, 
                    ssi.qty AS qty
                FROM `storage_stock_items` AS ssi
                LEFT JOIN `mm` AS mm ON mm.id = ssi.mat_id
                WHERE ssi.qty != 0
                AND ssi.str_loc = 10000
            )
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('available_materials_view');
    }
};
