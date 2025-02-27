<?php

namespace App\Services\HidroProjekt\Domain\Workers\Cooperators;

use Illuminate\Support\Collection;
use App\Models\AttendanceCoOpModel;

class CoOpWorkerAttendance
{
    /**
     * CoOp-Worker ID.
     * corresponding in DB: worker_id
     */
    private $workerID;

     /**
     * Daily report ID.
     * corresponding in DB: working_day_record_id
     */
    private $wdrID;

     /**
     * Actual working hours.
     * corresponding in DB: work_hours
     */
    private $hours;

     /**
     * Date of the work.
     * corresponding in DB: date
     */
    private $date;

    /**
     * Store the attendance of the worker here.
     */
    private $attendance;

    public function __construct(
        $workerID = NULL,
        $wdrID    = NULL,
        $hours    = NULL,
        $date     = NULL,
    )
    {
        $this->workerID = $workerID;
        $this->wdrID    = $wdrID;
        $this->hours    = $hours;
        $this->date     = $date;
        $this->setAttendance();
    }

    /**
     * Set the CoOp-Workers ID in the property $workerID.
     */
    public function setWorkerID($workerID){
        $this->workerID = $workerID;
        return $this;
    }

    /**
     * Set the daily report ID in the property $wdrID.
     */
    public function setWdrID($wdrID){
        $this->wdrID = $wdrID;
        return $this;
    }

    /**
     * Set the hours the CoOp-Worker has done in the property $workerID.
     */
    public function setHours($hours){
        $this->hours = $hours;
        return $this;
    }

    /**
     * Set the date of the work in the property $workerID.
     */
    public function setDate($date){
        $this->date = $date;
        return $this;
    }

    /**
     * This will set the attendance for the given data.
     * It will first check if there is a daily report ID set, then the date. 
     */
    public function setAttendance():void{
        //If the wdrID and workerID is set then give attendance based on that and return
        if($this->wdrID && $this->workerID){
            $this->attendance = AttendanceCoOpModel::where('working_day_record_id', $this->wdrID)->where('worker_id', $this->workerID)->first();
            return;
        }
        //If the workerID and date is set then give attendance based on that and return
        if($this->workerID && $this->date){
            $this->attendance = AttendanceCoOpModel::where('date', $this->date)->where('worker_id', $this->workerID)->get();
            return;
        }
        return;
    }

    /**
     * This method will check if there is a attendance record for the set wdrID.
     */
    public function hasAttendanceForThisReport():bool{
        //Return FALSE is the attendance is NULL
        if($this->attendance === NULL){
            return FALSE;
        }
        //If the attendance is a instance of Collection, then it can not be the record from a report
        //The worker should have one record of attendance for a daily report
        if($this->attendance instanceof Collection) { 
            return FALSE;
        }
        //Double check if the $this->wdrID did not changed
        //Return FALSE if the attendance ID  and wdrID do not match
        if($this->attendance->working_day_record_id != $this->wdrID) { 
            return FALSE;
        }
        //You deserve a TRUE if you came here
        return TRUE;
    }

    /**
     * With this method you will be able to create a new attendance record.
     */
    public function writeNewAttendance(){
        AttendanceCoOpModel::create([
            'worker_id'             => $this->workerID,
            'working_day_record_id' => $this->wdrID,
            'work_hours'            => $this->hours,
            'date'                  => $this->date
        ]);
        return;
    }

    public function updateAttendanceHours($newHours){
        $this->attendance->update(['work_hours' => $newHours]);
        return $this;
    }

}