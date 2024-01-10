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

    public static function createNewUser($request){
        $newWorker = WorkerModel::create([
            'firstName' => $request['firstName'],
            'lastName' => $request['lastName'],
            'company' => $request['lastName'],
            'employed' => 1,
            'OIB' => $request['OIB'],
            'working_place' => $request['working_place'],
            'doe' => $request['doe'],
            'print_label' => 1,
        ]);

    }
}
