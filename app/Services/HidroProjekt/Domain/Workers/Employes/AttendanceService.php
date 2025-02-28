<?php

namespace App\Services\HidroProjekt\Domain\Workers\Employes;

use App\Models\AttendanceModel;
use App\Models\WorkerModel;
use App\Models\WorkingDayRecordModel;

class AttendanceService
{   
    private $wdrId;
    private $type;
    private $date;
    private $attendance;
    private $worker;

    public function __construct(
        $wdrId = NULL,
        $type  = NULL,
        $date  = NULL,
        $worker = NULL, 
    )
    {
        $this->wdrId = $wdrId;
        $this->type  = $type;
        $this->date  = $date != NULL ? $date : WorkingDayRecordModel::where('id', $this->wdrId)->first()->date;
        $this->worker = $worker != NULL ? WorkerModel::where('id', $worker)->first() : NULL;
        $this->attendance = $this->wdrId != NULL ? $this->setAttendance() : NULL;
    }

    public function hasAttendance(){
        return !($this->attendance->get()->isEmpty());
    }

    public function updateAttendanceHours($hours){
        return $this->attendance->first()->update([
            'work_hours'     => $hours,
            'type'           => $this->type,
            'absence_reason' => NULL,
        ]);
    }

    public function updateAttendanceToAbsence($reason){
        return $this->attendance->first()->update([
            'work_hours'     => NULL,
            'type'           => NULL,
            'absence_reason' => $reason,
        ]);
    }

    public function deleteAttendance(){
        return $this->attendance->first()->delete();
    }

    public function createNewWorkHoursAttendance($worker = NULL, $hours, $type = NULL){
        $att = AttendanceModel::create([
            'worker_id'             => $worker != NULL ? $worker : $this->worker->id,
            'working_day_record_id' => $this->wdrId,
            'type'                  => $type != NULL ? $type : $this->type,
            'work_hours'            => $hours,
            'date'                  => $this->date,
        ]);
        return $this;
    }

    public function createNewAbsenceAttendance($worker, $abs){
        $att = AttendanceModel::create([
            'worker_id'             => $worker,
            'working_day_record_id' => $this->wdrId,
            'type'                  => NULL,
            'work_hours'            => NULL,
            'date'                  => $this->date,
            'absence_reason'        => $abs
        ]);
        return $this;
    }

    public function countWorkersInAttendance(){
        return AttendanceModel::where('working_day_record_id', $this->wdrId)->get()->count();
    }

    private function setAttendance(){
        if($this->worker){
            return AttendanceModel::where('working_day_record_id',$this->wdrId)->where('worker_id', $this->worker->id);
        }
    }

    public function getAttendance(){
        return $this->attendance;
    }

    public function findAttendanceByID($attID){
        $this->attendance = AttendanceModel::where('id', $attID);
        return $this;
    }
}