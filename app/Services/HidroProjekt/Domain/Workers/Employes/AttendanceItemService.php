<?php

namespace App\Services\HidroProjekt\Domain\Workers\Employes;

use App\Exceptions\AttendanceException;
use App\Models\AttendanceModel;
use App\Models\WorkerModel;

class AttendanceItemService{

    private $param;
    private $attObj = [];

    private function __construct()
    {
        // $this->param = [
        //     'worker_id' => NULL, 
        //     'working_day_record_id' => NULL, 
        //     'type' => NULL, 
        //     'work_hours' => NULL,
        //     'date' => date('Y-m-d'), 
        //     'absence_reason' => NULL
        // ];
    }

    public static function init()
    {
        return new self();
    }

    public function worker(int $worker){
        $this->param['worker_id'] = $worker;
        return $this;
    }

    public function workDiary(int $wdrID){
        $this->param['working_day_record_id'] = $wdrID;
        return $this;
    }

    public function type(int $type){
        $this->param['type'] = $type;
        return $this;
    }

    public function hours(int $workHours){
        $this->param['work_hours'] = $workHours;
        return $this;
    }

    public function date($date){
        if($date == NULL || $date == ""){
            $this->param['date'] = date('Y-m-d');
        }else{
            $this->param['date'] = $date;
        }
        return $this;
    }

    public function absence($reason){
        $this->param['absence_reason'] = $reason;
        return $this;
    }

    public function create(){
        /**
         * VALIDATION
         */
        //Worker
        if(!isset($this->param['worker_id'])){
            return throw new AttendanceException('worker-not-defined', $this->param['worker_id']);
        }
        if($this->param['worker_id'] == NULL || $this->param['worker_id'] == ""){
            return throw new AttendanceException('worker-missing', $this->param['worker_id']);
        }
        $worker = WorkerModel::where('id',$this->param['worker_id'])->get();
        if($worker->isEmpty()){
            return throw new AttendanceException('worker', $this->param['worker_id']);
        }

        //Absence reason
        if(isset($this->param['absence_reason'])){
            if(!in_array($this->param['absence_reason'], AttendanceModel::ABSENCE_REASON_ALLOWED)){
                return throw new AttendanceException('reason-not-defined', $this->param['absence_reason']);
            }
            //If absence is set, set work_hours and type to NULL for safety reasons
            $this->param['work_hours'] = NULL;
            $this->param['type'] = NULL;
        }

        //Create a new Attendance item in DB from $this->param
        $this->attObj = AttendanceModel::create($this->param);

        return $this->attObj;
    } 

    public function find(){
        $attendance = new AttendanceModel();
        foreach ($this->param as $key => $value) {
            $attendance = $attendance->where($key,$value);
        }
        $this->attObj = $attendance->get();
        return $this;
    }

    public function get(){
        return $this->attObj;
    }

    public function delete(){
        foreach($this->attObj as $att){
            $att->delete();
        }
        return $this;
    }
}
