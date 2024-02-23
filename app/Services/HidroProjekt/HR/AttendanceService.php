<?php

namespace App\Services\HidroProjekt\HR;

use App\Models\AttendanceModel;
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

}
