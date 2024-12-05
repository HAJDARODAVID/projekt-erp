<?php

namespace App\Services\HidroProjekt\HR;

use App\Models\AppParametersModel;
use App\Models\AttendanceCoOpModel;
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
        $groupLeaders= User::where('type', User::USER_TYPE_GROUP_LEADER)->where('active', TRUE)->with('getWorker')->get();
        $workers = WorkerModel::where('is_worker', TRUE)->where('status',1)->get();
        $attendanceWorker=[];
        foreach ($groupLeaders as $worker) {
            $attendanceWorker[$worker->worker_id] = $worker->getWorker->firstName ." ". $worker->getWorker->lastName;
        }
        foreach ($workers as $worker) {
            $attendanceWorker[$worker->id] = $worker->firstName ." ". $worker->lastName;
        }
        return $attendanceWorker;
    }

    public static function getAllAttendanceForMonthReport($month, $planedHours){
        $workers = self::getAllAttendanceWorkers();
        $attendance = AttendanceModel::whereMonth('date', '=', $month)->get();
        $completeAttendance=[];
        $cumulativeHours['planedHours']=0;
        $cumulativeHours['workHours']=0;
        $cumulativeHours['overTime']=0;
        $cumulativeHours['sickLeave']=0;
        $cumulativeHours['paidLeave']=0;
        $cumulativeHours['dates']=[];
        $workerCount=0;
        $daysOfTheMonth = Months::dayOfMonth($month);

        foreach ($workers as $key => $worker) {
            $completeAttendance[$key]['id'] = $key;
            $completeAttendance[$key]['name'] = $worker;

            $monthlyHours=0;
            $overTimeHours = 0;
            

            foreach($daysOfTheMonth as $day){
                $attendanceInfo = $attendance->where('worker_id', $key)->where('date', $day);
                $workerAttendanceInfo = NULL;
                if(!is_null($attendanceInfo)){
                    //absence
                    foreach ($attendanceInfo as $absence) {
                        if(!is_null($absence->absence_reason)){
                            $workerAttendanceInfo = AttendanceModel::ABSENCE_REASON_SHT_TXT[$absence->absence_reason];
                            if($absence->absence_reason == AttendanceModel::ABSENCE_REASON_PAID_LEAVE){
                                $monthlyHours += 8;
                            }
                        }
                    }

                    if(is_null($workerAttendanceInfo)){
                        $workerAttendanceInfo = $attendanceInfo->sum('work_hours') == NULL ? "" : $attendanceInfo->sum('work_hours');
                        $monthlyHours += $workerAttendanceInfo == "" ? 0 : $workerAttendanceInfo;
                        if($workerAttendanceInfo != ""){
                            if($workerAttendanceInfo > 8 || date("N", strtotime($day))>5){
                                if (date("N", strtotime($day))>5) {
                                    $overTimeHours += $workerAttendanceInfo;
                                }else{
                                    $overTimeHours += $workerAttendanceInfo - 8;
                                }
                            }
                        }
                    }
                }
                $completeAttendance[$key]['attendance'][$day]=$workerAttendanceInfo;
                $dayHours=NULL;
                if(!is_int($workerAttendanceInfo)){
                    if($workerAttendanceInfo == 'GO'){
                        $dayHours = 8;
                    }
                }else{
                    $dayHours = $workerAttendanceInfo;
                }
                
                if(!isset($cumulativeHours['dates'][$day])){
                    $cumulativeHours['dates'][$day] = $dayHours;
                }else{
                    $cumulativeHours['dates'][$day] += $dayHours;
                }
            }

            $completeAttendance[$key]['monthlyHours'] = $monthlyHours;
            $completeAttendance[$key]['overTime'] = $overTimeHours;

            $completeAttendance[$key]['paidLeave'] = self::getPaidLeaveForMonthAndWorker($key, $month);
            $completeAttendance[$key]['sickLeave'] = self::getSickLeaveForMonthAndWorker($key, $month);

            $cumulativeHours['workHours'] += $monthlyHours;
            $cumulativeHours['overTime'] += $overTimeHours;

            $workerCount++;
        }

        $cumulativeHours['planedHours'] = $workerCount * $planedHours;
        $cumulativeHours['paidLeave'] += self::getPaidLeaveForMonth($month);
        $cumulativeHours['sickLeave'] += self::getSickLeaveForMonth($month);

        $completeAttendance = [
            'attendance' => $completeAttendance,
            'cumulative' => $cumulativeHours
        ];
        //dd($completeAttendance);
        return $completeAttendance;
    }

    public static function getPlanedHoursForMonth($month){
        $daysOfTheMonth = Months::dayOfMonth($month);
        $planedHours = 0;
        foreach ($daysOfTheMonth as $day) {
            if(date("N", strtotime($day)) < 6){
                $planedHours += 8; 
            }
        }
        return $planedHours;
    }

    private static function getSickLeaveForMonthAndWorker($workerId, $month){
        $sickLeaveCount = AttendanceModel::where('worker_id', $workerId)
            ->where('absence_reason', AttendanceModel::ABSENCE_REASON_SICK_LEAVE)
            ->whereMonth('date','=',$month)
            ->pluck('absence_reason')
            ->count();       
        //dd($sickLeaveCount);
        return $sickLeaveCount;
    }

    private static function getSickLeaveForMonth($month){
        $sickLeaveCount = AttendanceModel::where('absence_reason', AttendanceModel::ABSENCE_REASON_SICK_LEAVE)
            ->whereMonth('date','=',$month)
            ->pluck('absence_reason')
            ->count();       
        //dd($sickLeaveCount);
        return $sickLeaveCount;
    }

    private static function getPaidLeaveForMonthAndWorker($workerId, $month){
        $sickLeaveCount = AttendanceModel::where('worker_id', $workerId)
            ->where('absence_reason', AttendanceModel::ABSENCE_REASON_PAID_LEAVE)
            ->whereMonth('date','=',$month)
            ->pluck('absence_reason')
            ->count();       
        //dd($sickLeaveCount);
        return $sickLeaveCount;
    }

    private static function getPaidLeaveForMonth($month){
        $sickLeaveCount = AttendanceModel::where('absence_reason', AttendanceModel::ABSENCE_REASON_PAID_LEAVE)
            ->whereMonth('date','=',$month)
            ->pluck('absence_reason')
            ->count();       
        //dd($sickLeaveCount);
        return $sickLeaveCount;
    }

    public static function getAllAttendanceForMonthReportCoOp($month, $year, $daysInMonth){
        $sumPerDay=[];
        $baseWorkHourCost = (float)AppParametersModel::where('param_name_srt', 'bwh-c-o')->where('active', TRUE)->first()->value;
        $attendance = AttendanceCoOpModel::whereMonth('date', '=', $month)
            ->whereYear('date', '=', $year)
            ->where('work_hours', '!=', NULL)
            ->with('getWorkerInfo', 'getWorkerInfo.getCoOpInfo')->get();
        $array=[];
        foreach ($attendance as $att) {
            $coOp=$att->getWorkerInfo->getCoOpInfo->name;
            $array[$coOp][$att->worker_id]['id'] = $att->worker_id;
            $array[$coOp][$att->worker_id]['name'] = $att->getWorkerInfo->firstName .' '. $att->getWorkerInfo->lastName;
            $array[$coOp][$att->worker_id]['overall'] = 0;
            $array[$coOp][$att->worker_id]['cost'] = 0;

            foreach($daysInMonth as $day){
                $attInfo = $attendance->where('date', $day)->where('worker_id', $att->worker_id)->sum('work_hours');
                if($attInfo){
                    $array[$coOp][$att->worker_id]['dates'][$day] = $attInfo == 0 ? NULL : $attInfo; 
                    $array[$coOp][$att->worker_id]['overall'] += $attInfo; 
                    $array[$coOp][$att->worker_id]['cost'] += $attInfo*$baseWorkHourCost;                     
                }else{
                    $array[$coOp][$att->worker_id]['dates'][$day] = NULL;
                }
                
            }
        }

        foreach ($daysInMonth as $day) {
            $sumPerDay[$day]=$attendance->where('date', $day)->sum('work_hours') == 0 ? NULL : $attendance->where('date', $day)->sum('work_hours');
        }

        $overAllCost=0;
        foreach ($array as $group) {
            foreach ($group as $key => $att) {
                $overAllCost += $att['cost'];
            }    
        }

        $groups=[];
        foreach ($array as $key => $group) {
            $workers=[];
            foreach ($group as $worker => $data) {
                $workers[] = $worker;
            }
            foreach ($daysInMonth as $day){
                $groups[$key][$day] = $attendance->where('date', $day)->whereIn('worker_id', $workers)->sum('work_hours') == 0 ? NULL : $attendance->where('date', $day)->whereIn('worker_id', $workers)->sum('work_hours');
            }  
        }

        $finalArray= [
            'workerAttendance' => $array,
            'sumPerDay' => $sumPerDay,
            'overAllCost' => $overAllCost,
            'groupPerDay' => $groups,
        ];

        return $finalArray;
    }

    

}
