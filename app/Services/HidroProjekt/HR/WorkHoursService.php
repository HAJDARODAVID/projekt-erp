<?php

namespace App\Services\HidroProjekt\HR;

use App\Models\AttendanceModel;
use App\Models\User;
use App\Models\WorkerModel;
use App\Services\Months;

/**
 * Class WorkHoursService.
 */
class WorkHoursService
{
    private static function getAllAttendanceWorkers(){
        $groupLeaders= User::where('type', User::USER_TYPE_GROUP_LEADER)->with('getWorker')->get();
        $workers = WorkerModel::where('is_worker', TRUE)->get();
        $attendanceWorker=[];
        foreach ($groupLeaders as $worker) {
            $attendanceWorker[$worker->worker_id] = $worker->getWorker->firstName ." ". $worker->getWorker->lastName;
        }
        foreach ($workers as $worker) {
            $attendanceWorker[$worker->id] = $worker->firstName ." ". $worker->lastName;
        }
        return $attendanceWorker;
    }

    public static function getAllAttendanceForMonth($month){
        $workers = self::getAllAttendanceWorkers();
        $attendance = AttendanceModel::whereMonth('date', '=', $month)->get();
        $completeAttendance=[];
        $daysOfTheMonth = Months::dayOfMonth($month);

        foreach ($workers as $key => $worker) {
            $completeAttendance[$key]['name'] = $worker;

            foreach($daysOfTheMonth as $day){
                $attendanceInfo = $attendance->where('worker_id', $key)->where('date', $day);
                $workerAttendanceInfo = NULL;
                if(!is_null($attendanceInfo)){
                    //absence
                    foreach ($attendanceInfo as $absence) {
                        if(!is_null($absence->absence_reason)){
                            $workerAttendanceInfo = AttendanceModel::ABSENCE_REASON_SHT_TXT[$absence->absence_reason];
                        }
                    }

                    if(is_null($workerAttendanceInfo)){
                        $workerAttendanceInfo = $attendanceInfo->sum('work_hours') == NULL ? "" : $attendanceInfo->sum('work_hours');
                    }
                }
                $completeAttendance[$key]['attendance'][$day]=$workerAttendanceInfo;
            }

        }

        //dd($completeAttendance);

        return $completeAttendance;

    }

    

}
