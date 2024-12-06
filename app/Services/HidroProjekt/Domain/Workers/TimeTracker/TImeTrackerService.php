<?php

namespace App\Services\HidroProjekt\Domain\Workers\TimeTracker;

use App\Models\AttendanceModel;
use App\Models\User;
use App\Models\WorkerModel;
use App\Services\Months;

class TImeTrackerService
{ 
    private $month;
    private $year;
    private $data=[];

    public function __construct(
        $month,
        $year,
        )
    {
        $this->month = $month;
        $this->year = $year;
        $this->getAllWorkers()
            ->setWorkersName()
            ->setTimeTrackerData();
    }

    public function getData(){
        return $this->data;
    }

    private function setTimeTrackerData(){
        $days = Months::dayOfMonth($this->month,$this->year);
        foreach ($this->data as $workerID => $array) {
            foreach ($days as $day) {
                $this->data[$workerID]['days'][$day] = $this->getAttendance($workerID,$day);
            }
            $this->data[$workerID]['sick_leave'] = $this->getAbsenceCount($workerID, "sick_leave");
            $this->data[$workerID]['paid_leave'] = $this->getAbsenceCount($workerID, "paid_leave");
            $this->data[$workerID]['hours_overall'] = $this->getHoursOverall($workerID) + ($this->data[$workerID]['paid_leave']*8);
            $this->data[$workerID]['planed_hours'] = $this->getPlanedHours($days);
        }
        return $this;
    }

    private function getAllWorkers(){
        $groupLeader = User::where('type', User::USER_TYPE_GROUP_LEADER)->where('active', TRUE)->select('worker_id')->groupBy('worker_id')->pluck('worker_id')->toArray();
        $workers = WorkerModel::where('status', WorkerModel::WORKER_STATUS_EMPLOYED)->where('is_worker', TRUE)->select('id')->groupBy('id')->pluck('id')->toArray();
        $att = AttendanceModel::whereYear('date', $this->year)->whereMonth('date', $this->month)->select('worker_id')->groupBy('worker_id')->pluck('worker_id')->toArray();

        foreach($groupLeader as $leader){
            $this->data[$leader] = NULL;
        }
        foreach($workers as $worker){
            $this->data[$worker] = NULL;
        }
        foreach($att as $a){
            $this->data[$a] = NULL;
        }
        return $this;
    }

    private function getAttendance($workerID,$day){
        //Check if multiple absences
        $abs = AttendanceModel::where('worker_id',$workerID)->where('date', $day);
        if($abs->where('absence_reason', '!=', NULL)->get()->count()>1){
            return 'ERR';
        }
        if($abs->where('absence_reason', '!=', NULL)->get()->count()==1){
            return 'A:'.$abs->first()->absence_reason;
        }
        return AttendanceModel::where('worker_id',$workerID)->where('date', $day)->get()->sum('work_hours');
    }

    public function setWorkersName(){
        foreach ($this->data as $workerID => $array){
            $this->data[$workerID]['firstName'] = WorkerModel::where('id', $workerID)->first()->firstName;
            $this->data[$workerID]['lastName'] = WorkerModel::where('id', $workerID)->first()->lastName;
            $this->data[$workerID]['fullName'] = WorkerModel::where('id', $workerID)->first()->fullName;
        }
        return $this;
    }

    private function getHoursOverall($workerID){
        return AttendanceModel::where('worker_id',$workerID)->whereMonth('date', $this->month)->get()->sum('work_hours');
    }

    private function getAbsenceCount($workerID, $type){
        switch ($type) {
            case 'sick_leave':
                    return AttendanceModel::where('worker_id',$workerID)->whereMonth('date', $this->month)->where('absence_reason', AttendanceModel::ABSENCE_REASON_SICK_LEAVE)->count();
                break;
            case 'paid_leave':
                    return AttendanceModel::where('worker_id',$workerID)->whereMonth('date', $this->month)->where('absence_reason', AttendanceModel::ABSENCE_REASON_PAID_LEAVE)->count();
                break;
            
            default:
                # code...
                break;
        }
    }

    private function getPlanedHours($days){
        $hours = 0;
        foreach($days as $day){
            if(date('N', strtotime($day))<=5){
                $hours = $hours+8;
            }
        }
        return $hours;
    }
}