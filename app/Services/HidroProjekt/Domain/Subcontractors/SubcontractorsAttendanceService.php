<?php

namespace App\Services\HidroProjekt\Domain\Subcontractors;

use App\Models\CooperatorsModel;
use App\Models\AttendanceCoOpModel;
use App\Models\CooperatorWorkersModel;
use App\Models\WorkingDayRecordModel;

/**
 * Class SubcontractorsService.
 */
class SubcontractorsAttendanceService
{
    private $wdrID;
    private $wdrObj;
    private $worker;
    private $attendance;

    public function __construct(
        $wdrID = NULL,
        $workerID = NULL,
    )
    {
        $this->wdrID = $wdrID;
        $this->wdrObj = $this->wdrID != NULL ? WorkingDayRecordModel::where('id', $this->wdrID)->first() : NULL;
        $this->worker = $workerID != NULL ? CooperatorWorkersModel::where('id' , $workerID)->first() : NULL;
    }

    public function getAttendanceForWorkDayAndWorker($return = TRUE){
        if($this->wdrID != NULL && $this->worker != NULL){
            $this->attendance = AttendanceCoOpModel::where('worker_id', $this->worker->id)->where('working_day_record_id', $this->wdrID)->first();
            if($return){
                return $this->attendance;
            }else{
                return $this;
            }
        }
        $this->attendance = NULL;
        if($return){
            return $this->attendance;
        }else{
            return $this;
        }
    }

    public function setAttendance($hours){
        if($this->hasAttendance()){
            $this->attendance->update([
                'work_hours' => $hours,
            ]);
            if($hours == ''){
                $this->removeAttendance();
            }
        }else{
            $this->createNewAttendance($hours);
        }
    }

    private function createNewAttendance($hours){
        $this->attendance = AttendanceCoOpModel::create([
                                'worker_id' => $this->worker->id, 
                                'working_day_record_id' => $this->wdrObj->id, 
                                'work_hours' => $hours, 
                                'date' => $this->wdrObj->date
                            ]);
        return $this;
    }

    public function hasAttendance(){
        return $this->attendance != NULL ? TRUE : FALSE;
    }

    public function removeAttendance(){
        return $this->attendance->delete();
    }

    public function countWorkersInAttendance(){
        return AttendanceCoOpModel::where('working_day_record_id', $this->wdrID)->get()->count();
    }

}
