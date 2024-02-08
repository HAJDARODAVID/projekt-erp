<?php

namespace App\Services\HidroProjekt\BDE;

use Livewire\Wireable;
use Illuminate\Support\Facades\DB;
use App\Models\AttendanceCoOpModel;
use App\Models\WorkingDayRecordModel;

use App\Models\CooperatorWorkersModel;
use function PHPUnit\Framework\isNull;
use function PHPUnit\Framework\isEmpty;

/**
 * Class CooperatorsAttendanceService.
 */
class CooperatorsAttendanceService
{
    public static function setAttendanceForCoOpWorkers($entry, $coOpTeam){
        $workingDayEntry = WorkingDayRecordModel::where('id', $entry)->first();
        $workers=CooperatorWorkersModel::where('cooperator_id', $coOpTeam)
            ->where('status', CooperatorWorkersModel::COOPERATORS_WORKER_STATUS_ACTIVE)
            ->get();
        $attendance=AttendanceCoOpModel::where('working_day_record_id', $entry)->get();

        if($workers->count()){
            if(empty($attendance)){
                foreach ($workers as $worker) {
                    AttendanceCoOpModel::create([
                        'worker_id' => $worker->id,
                        'working_day_record_id' => $entry,
                        'work_hours' => null,
                        'date' => $workingDayEntry->date,
                    ]);
                }
                return;
            }
            if(!empty($attendance)){
                $workersInAttendance = [];
                foreach($attendance as $att){
                    $workersInAttendance[$att->worker_id] = $att->toArray();
                }

                foreach ($workers as $worker) {
                    if(empty($workersInAttendance[$worker->id])){
                        AttendanceCoOpModel::create([
                            'worker_id' => $worker->id,
                            'working_day_record_id' => $entry,
                            'work_hours' => null,
                            'date' => $workingDayEntry->date,
                        ]);
                    }
                }
                return;
            }
        }
        return;
    }

    public static function getCoOpAttendanceForEntry($entry){
        $attendance=DB::table('attendance_co_op')
            ->select(
                'attendance_co_op.*',
                'cooperator_workers.cooperator_id',
                'cooperator_workers.firstName',
                'cooperator_workers.lastName',
                'cooperators.name'
                )
            ->leftJoin('cooperator_workers', 'attendance_co_op.worker_id', 'cooperator_workers.id')
            ->leftJoin('cooperators', 'cooperator_workers.cooperator_id', 'cooperators.id')
            ->where('attendance_co_op.working_day_record_id' ,'=', $entry)
            ->get();

        $sortedByGroup=[];
        foreach ($attendance as $att) {
            $sortedByGroup[$att->name][] = get_object_vars($att);
        }
        return $sortedByGroup;
    }

    public static function removeGroupFromAttendance($groupItems){
        foreach ($groupItems as $wrkInAtt) {
            AttendanceCoOpModel::find($wrkInAtt['id'])->delete();
        }
        return;
    }

    public static function getWorkerHoursForEntry($wrk, $entry){
        return AttendanceCoOpModel::where('id', $wrk)
                    ->where('working_day_record_id', $entry)
                    ->pluck('work_hours')->first();
    }

    public static function updateWorkerHours($att, $hours){
        $attendance = AttendanceCoOpModel::find($att);
        $attendance->update([
            'work_hours' => $hours == "" ? NULL : $hours,
        ]);
        return;
    } 

    public static function removeWorkerFromAttendance($att){
        $attendance = AttendanceCoOpModel::find($att);
        $attendance->delete();
        return;
    }

    public static function getWorkerCount($att){
        return AttendanceCoOpModel::where('working_day_record_id',$att)->pluck('id')->count();
    }



}
