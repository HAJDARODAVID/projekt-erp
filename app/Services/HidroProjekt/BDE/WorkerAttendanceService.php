<?php

namespace App\Services\HidroProjekt\BDE;

use App\Models\AttendanceModel;

/**
 * Class WorkerAttendanceService.
 */
class WorkerAttendanceService
{
    public static function getAttendanceForWorkingDayEntry($worker, $workDayEntry){
        $attendance = AttendanceModel::where('worker_id',$worker)
        ->where('working_day_record_id',$workDayEntry)->first();

        if(is_null($attendance)){
            return NULL;
        }else{
            return $attendance;
        }
    }

}
