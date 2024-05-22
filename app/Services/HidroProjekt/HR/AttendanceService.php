<?php

namespace App\Services\HidroProjekt\HR;

use App\Models\AttendanceModel;
use App\Models\WorkerModel;
use DatePeriod;
use DateInterval;

/**
 * Class AttendanceService.
 */
class AttendanceService
{
    public function setAbsenceReasonToAttendance($data){
        $dates = $data['dates'];
        $worker = $data['worker'];
        $absenceReason = $data['type'];

        $startDate = date_create($dates['startDate']);
        $endDate = date_create($dates['endDate']);
        $endDate->modify('+1 day');
        $interval = new DateInterval('P1D');
        $date_range = new DatePeriod($startDate, $interval, $endDate);
        $dayArray=[];
        foreach ($date_range as $day) {
            $att=AttendanceModel::where('date', $day->format("Y-m-d"))->where('worker_id', $worker)->first();
            if(date("N", strtotime($day->format("Y-m-d")))<6 && is_null($att)){
                AttendanceModel::create([
                    'worker_id' => $worker,
                    'working_day_record_id'=> NULL, 
                    'type' => NULL, 
                    'work_hours' => NULL, 
                    'absence_reason' => $absenceReason, 
                    'date' => $day->format("Y-m-d")
                ]);
                $dayArray[]=$day->format("Y-m-d");
            }  
        }
        return;
    }

    public function getDataForWorkerAttendanceReport($month){
        $att=AttendanceModel::whereMonth('date', $month)
            ->with('getWorkerInfo')
            ->orderBy('worker_id', 'asc')
            ->get();
        $workers = $att->groupBy('worker_id');
        $data=[];
        $i=0;
        foreach ($workers as $key => $wrk) {
            $wrkInfo = WorkerModel::find($key);
            $data[$i] = [
                'id'         => sprintf('%04d',$key),
                'worker'     => $wrkInfo->firstName . ' ' . $wrkInfo->lastName,
                'bonus'      => $wrk->where('absence_reason', AttendanceModel::ABSENCE_REASON_SICK_LEAVE)->count() == 0 ? 'X' : NULL,
                'work_hours' => $wrk->sum('work_hours') + ($wrk->where('absence_reason', AttendanceModel::ABSENCE_REASON_PAID_LEAVE)->count() * 8),
                'home'       => $wrk->where('type', 1)->where('work_hours','!=', NULL)->count(),
                'field'       => $wrk->where('type', 2)->where('work_hours','!=', NULL)->count(),
                'BO'         => $wrk->where('absence_reason', AttendanceModel::ABSENCE_REASON_SICK_LEAVE)->count(),
                'GO'         => $wrk->where('absence_reason', AttendanceModel::ABSENCE_REASON_PAID_LEAVE)->count(),
            ];
            $i++;
        }
        return $data;
    }

    public function getAllAttendanceDataForMonthly($month=3){
        $att = AttendanceModel::query()
            ->leftJoin('working_day_record', 'working_day_record.id', '=', 'attendance.working_day_record_id')
            ->leftJoin('construction_sites', 'construction_sites.id', '=', 'working_day_record.construction_site_id')
            ->leftJoin('workers', 'workers.id', '=', 'attendance.worker_id')
            ->select('attendance.date', 'attendance.worker_id', 'workers.firstName', 'workers.lastName','construction_sites.name', 'attendance.type', 'attendance.work_hours', 'attendance.absence_reason')
            ->whereMonth('attendance.date', $month)
            ->get()->toArray();
        
        foreach ($att as $key => $row) {
            $att[$key]['absence_reason'] = $row['absence_reason'] == NULL ? NULL : AttendanceModel::ABSENCE_REASON_SHT_TXT[$row['absence_reason']];
            $att[$key]['worker_id'] = sprintf('%04d',$row['worker_id']);
        }
       return $att;
    }


}
