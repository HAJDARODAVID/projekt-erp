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
            CREATE VIEW internal_delivery_note_view AS
            (
                SELECT 
                    md.id, 
                    mv.mvt, 
                    cs.name as job_site_name, 
                    us.name as created_by, 
                    md.created_at  
                FROM `material_mvt` as mv
                LEFT JOIN `material_doc` as md ON md.id = mv.mat_doc_id
                LEFT JOIN `users` as us ON md.created_by = us.id
                LEFT JOIN `construction_sites` as cs ON cs.id = mv.const_id
                WHERE mv.const_id IS NOT NULL
                GROUP BY mv.mat_doc_id
            )
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internal_delivery_note_view');
    }
};
