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
                    md.mvt_type, 
                    cs.name, 
                    us.name as created_by, 
                    md.created_at 
                FROM `material_doc` as md
                LEFT JOIN `material_mvt` as mv ON md.id = mv.mat_doc_id
                LEFT JOIN `construction_sites` as cs ON mv.const_id = cs.id
                LEFT JOIN `users` as us ON md.created_by = us.id
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
