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

    public static function setWorkerAttendance($worker, $workDayEntry,$hours){
        $attendance = AttendanceModel::where('worker_id',$worker)
        ->where('working_day_record_id',$workDayEntry->id)->first();
        if(is_null($attendance)){
            AttendanceModel::create([
                'worker_id' => $worker,
                'working_day_record_id' => $workDayEntry->id,
                'type' => $workDayEntry->work_type,
                'work_hours' => $hours == "" ? NULL : $hours,
                'absence_reason' => NULL,
                'date' => $workDayEntry->date,
            ]);
        }else{
            $attendance->update([
                'work_hours' => $hours == "" ? NULL : $hours,
            ]);
        }
    }

}
