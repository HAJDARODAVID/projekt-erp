<?php

namespace App\Services\HidroProjekt\HR;

use App\Models\WorkerModel;

/**
 * Class WorkerService.
 */
class WorkerService
{
    public static function updatePrintPayrollLabel($worker, $value){
        WorkerModel::where('id', $worker)->update([
            'print_label' => $value,
        ]);
    }
}
