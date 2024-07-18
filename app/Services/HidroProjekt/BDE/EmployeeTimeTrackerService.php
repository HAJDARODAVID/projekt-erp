<?php

namespace App\Services\HidroProjekt\Bde;

use App\Models\AttendanceModel;
use App\Services\Days;
use DateTime;

/**
 * Class EmployeeTimeTrackerService.
 */
class EmployeeTimeTrackerService
{
    protected $month;
    protected $year;
    protected $employeeId;
    protected $data = [];
    protected $summing = [];

    public function __construct($month=NULL, $year=NULL, $employeeId=NULL)
    {
        $this->month      = $month;
        $this->year       = $year;
        $this->employeeId = $employeeId;
    }

    public function getEmployeeTimesForMonth(){
        //sets the dates array
        $this->setDatesArray();
        
        $attendanceForWorker = AttendanceModel::where('worker_id', $this->employeeId)->whereYear('date', $this->year)->get();
        foreach ($this->data as $cw => $week) {
            foreach ($week as $day => $info) {
                $attendance = $attendanceForWorker->where('date', $day);
                $absence_reason = $attendance->where('absence_reason', '!=', NULL)->first();
                $work_hours = $attendance->sum('work_hours');
                $this->data[$cw][$day]['att'] = is_null($absence_reason?->absence_reason) ? $work_hours : $absence_reason?->absence_reason;
            }
        }

        $attendance = AttendanceModel::where('worker_id', $this->employeeId)->whereYear('date', $this->year)->whereMonth('date', $this->month);
        //dd($this->summing, $attendance->where('absence_reason', AttendanceModel::ABSENCE_REASON_SICK_LEAVE)->count());
        $this->summing = [
            'hours' => $attendance->sum('work_hours'),
            'GO' => $attendance->where('absence_reason', AttendanceModel::ABSENCE_REASON_PAID_LEAVE)->count(),
            'BO' => $attendance->where('absence_reason', AttendanceModel::ABSENCE_REASON_SICK_LEAVE)->count(),
        ];
        dd($this->summing, $attendance->get());
        return $this;
    }

    protected function setDatesArray(){
        $firstOfMonth = mktime(0, 0, 0,$this->month  , 1, $this->year);
        $weekday = date('N', $firstOfMonth);
        $date = new DateTime(date('Y-m-d', $firstOfMonth));
        $lastDayOfMonth = (new DateTime(date('Y-m-d', mktime(0, 0, 0,$this->month+1 , 1, $this->year))));
        $lastDayOfMonth->modify("-1 day");
        //get the first date in the week
        $date->modify("-". $weekday -1 ." day");
        //get the week number
        $weekNumber = $date->format("W");

        do {
            if($weekNumber != $date->format("W")){
                $weekNumber = $date->format("W");
            }
            $this->data[$weekNumber][$date->format("Y-m-d")]= [
                'day_sht' => Days::DAYS_HR_SHT[$date->format("N")],
            ];
            $date->modify("+1 day");
            if($date->format("N") == 7){
                $date->modify("+1 day");
            }
            
        } while ($date->format("Y-m-d") <= $lastDayOfMonth->format("Y-m-d"));
        $date->modify("-1 day");

        $missingDaysCount = 7 - $date->format("N");

        for ($i=1; $i <= $missingDaysCount ; $i++) { 
            $date->modify("+1 day");
            if($date->format("N") == 7){
                continue;
            }
            $this->data[$weekNumber][$date->format("Y-m-d")]=[
                'day_sht' => Days::DAYS_HR_SHT[$date->format("N")],
            ];
        }
        return; 
    }

    public function getData(){
        return $this->data;
    }

    public function getSumming(){
        return $this->summing;
    }

}
