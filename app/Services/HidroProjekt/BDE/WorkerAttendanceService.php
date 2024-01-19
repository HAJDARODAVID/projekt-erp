<?php

namespace App\Services\HidroProjekt\BDE;

use App\Models\AttendanceModel;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkingDayRecordModel;

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

    public static function setWorkerAttendance($worker, $workDayEntry,$hours=999){
        
        if(!is_object($workDayEntry)){
            $workDayEntry = self::getWorkDayEntry($workDayEntry);
        }

        if($hours==999){
            $groupLeaderHours = AttendanceModel::where('worker_id',Auth::user()->worker_id)->where('working_day_record_id',$workDayEntry->id)->first();
            if(isset($groupLeaderHours)){
                if(is_null($groupLeaderHours->work_hours) || !isset($groupLeaderHours)){
                    //IF Group leader has NULL as work hours set my value as NULL
                    $hours="";
                }else{
                    /**
                     * ELSE set my hours as the Group leaders
                     * Update 19.01.2024: no matter what set the hours to NULL
                     * -->Requested by: Lucija Šoštarek
                     */
                    //$hours = $groupLeaderHours->work_hours;
                    $hours="";
                }
            }else{
                $hours="";
            }        
        }
        
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

    private static function getWorkDayEntry($id){
        return WorkingDayRecordModel::find($id);
    }

    public static function getWorkerAttendanceForEntry($worker,$entry){
        return AttendanceModel::where('worker_id',$worker)
        ->where('working_day_record_id',$entry)->first();
    }

    public static function getWorkerCount($entry){
        return AttendanceModel::where('working_day_record_id',$entry)->pluck('id')->count();
    }

    public static function getAllWorkersForEntry($entry, $onlyWorkers=false){
        if($onlyWorkers){
            return AttendanceModel::where('worker_id', '!=', Auth::user()->worker_id )
            ->where('working_day_record_id',$entry)
            ->with('getWorkerInfo')->get();
        }
        return AttendanceModel::where('working_day_record_id',$entry)->with('getWorkerInfo')->get(); 
    }

    public static function removeWorkerFromAttendance($id,$entry){
        return AttendanceModel::where('working_day_record_id',$entry)
            ->where('worker_id', $id)
            ->delete(); 
    }

}
