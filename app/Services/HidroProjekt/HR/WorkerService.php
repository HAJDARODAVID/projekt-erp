<?php

namespace App\Services\HidroProjekt\HR;

use App\Models\WorkerAddress;
use App\Models\WorkerContact;
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
            'company' => WorkerModel::DEFAULT_COMPANY,
            'employed' => 1,
            'OIB' => $request['OIB'],
            'working_place' => $request['working_place'],
            'doe' => $request['doe'],
            'ced' =>$request['ced'],
            'comment' => $request['comment'],
            'print_label' => 1,
        ]);

        WorkerAddress::create([
            'worker_id' => $newWorker->id,
            'street' => $request['street'],
            'town' => $request['town'],
            'zip' => $request['zip'],
            'county' => $request['county'],
        ]);

        WorkerContact::create([
            'worker_id' => $newWorker->id,
            'mob' => $request['mob'],
            'email' => $request['email'],
        ]);
    }

    public static function updateNewUser($request,$id){
        $worker = WorkerModel::where('id', $id)->first();
        $workerAddress = WorkerAddress::where('worker_id', $id)->first();
        $workerContact = WorkerContact::where('worker_id', $id)->first();
        $worker->update([
            'company' => WorkerModel::DEFAULT_COMPANY,
            'employed' => 1,
            'OIB' => $request['OIB'],
            'working_place' => $request['working_place'],
            'doe' => $request['doe'],
            'ced' =>$request['ced'],
            'comment' => $request['comment'],
            'print_label' => 1,
        ]);

        $workerAddress->update([
            'street' => $request['street'],
            'town' => $request['town'],
            'zip' => $request['zip'],
            'county' => $request['county'],
        ]);

        $workerContact->update([
            'mob' => $request['mob'],
            'email' => $request['email'],
        ]);

    }
}
