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
            CREATE VIEW int_orders_view AS
            (
                SELECT 
                    io.id as id,
                    cs.name as const_name,
                    concat(wo.firstName, ' ', wo.lastName) as ordered_by,
                    io.status as status,
                    io.remark as remark
                FROM int_orders as io
                LEFT JOIN users as us ON io.ordered_by = us.id
                LEFT JOIN workers as wo ON us.worker_id = wo.id
                LEFT JOIN construction_sites as cs ON io.const_id = cs.id;
            )
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('int_orders_view');
    }
};
