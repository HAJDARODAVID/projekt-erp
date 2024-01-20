<?php

namespace App\Services\HidroProjekt\BDE;

use App\Models\AttendanceModel;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkingDayRecordModel;

/**
 * Class WorkingDayRecordService.
 */
class WorkingDayRecordService
{
    public static function deleteEntry($entryId){
        //Delete everyone from attendance
        $attendance = WorkerAttendanceService::getAllWorkersForEntry($entryId);
        foreach($attendance as $worker){
            WorkerAttendanceService::removeWorkerFromAttendance($worker->worker_id, $entryId);
        }

        //Delete entry self
        WorkingDayRecordModel::where('id', $entryId)->delete();
    }

}