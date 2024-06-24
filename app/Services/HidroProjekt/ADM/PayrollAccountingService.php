<?php

namespace App\Services\HidroProjekt\ADM;

use App\Models\AppParametersModel;
use App\Models\AttendanceModel;
use App\Models\WorkerModel;

/**
 * Class PayrollAccountingService.
 */
class PayrollAccountingService
{
    protected $month;
    protected $year;
    protected $attendance;

    public $data = [];
    public $field_1;
    public $field_2;
    public $bonus;

    public function __construct($month, $year){
        $this->month = $month;
        $this->year  = $year;
        $this->attendance = $this->getAttendance();
        $this->field_1 = AppParametersModel::where('param_name_srt', 'adm-fwb-home')->pluck('value')->first();
        $this->field_2 = AppParametersModel::where('param_name_srt', 'adm-fwb-field')->pluck('value')->first();
        $this->bonus = AppParametersModel::where('param_name_srt', 'adm-wb')->pluck('value')->first();

        $this->execute();
    }

    protected function execute(){
        //Get all workers to property data
        $this->data = $this->getAllWorkersForPayroll();
        //Fill workers with data
        foreach ($this->data as $key => $worker) {
            $this->data[$key]['h_rate']        = 8.53;
            $this->data[$key]['hours']         = $this->getWorkerHours($key);
            $this->data[$key]['go']            = $this->getPaidLeaveCount($key);
            $this->data[$key]['bo']            = $this->getSickLeaveCount($key);
            $this->data[$key]['field_1']       = $this->getFieldICount($key);
            $this->data[$key]['field_2']       = $this->getFieldIICount($key);
            $this->data[$key]['base']          = $this->data[$key]['hours'] * $this->data[$key]['h_rate'];
            $this->data[$key]['bonus_field_1'] = $this->data[$key]['field_1'] * $this->field_1;
            $this->data[$key]['bonus_field_2'] = $this->data[$key]['field_2'] * $this->field_2;
            $this->data[$key]['bonus']         = $this->getBonus($key);
            $this->data[$key]['pay_out']       = $this->getFinalPayOut($key);
        }
        return;
        dd($this->data);
    }

    private function getAllWorkersForPayroll(){
        //Get active workers
        $activeWorkersModel = WorkerModel::where('status', 1)->get();
        $workerArray = [];
        foreach ($activeWorkersModel as $worker) {
            $workerArray[$worker->id] = [
                'fullName' => $worker->fullName,
            ];
        }
        //Get workers who are not with us anymore :(
        foreach ($this->attendance->groupBy('worker_id') as $key => $att) {
            if(!array_key_exists($key, $workerArray)){
                $oldWorker = WorkerModel::where('id', $key)->first();
                $workerArray[$oldWorker->id] = ['fullName' => $oldWorker->fullName];
            }
        }
        return $workerArray;
    }

    private function getAttendance(){
        $attendance = AttendanceModel::whereMonth('date', $this->month)
            ->whereYear('date', $this->year)
            ->get();
        return $attendance;
    }

    private function getAttendanceForOneWorker($workerId){
        return $this->attendance->groupBy('worker_id')[$workerId];
    }

    private function getWorkerHours($workerId){
        if(isset($this->attendance->groupBy('worker_id')[$workerId])){
            $attendance = $this->attendance->groupBy('worker_id')[$workerId];
            $hoursSum = $attendance->sum('work_hours');
            return $hoursSum + ($this->getPaidLeaveCount($workerId)*8);
        }
        return 0;
    }

    private function getPaidLeaveCount($workerId){
        if(isset($this->attendance->groupBy('worker_id')[$workerId])){
            $attendance = $this->attendance->groupBy('worker_id')[$workerId];
            $goCount = $attendance->where('absence_reason', AttendanceModel::ABSENCE_REASON_PAID_LEAVE)->count();
            return $goCount;
        }
        return 0;
    }

    private function getSickLeaveCount($workerId){
        if(isset($this->attendance->groupBy('worker_id')[$workerId])){
            $attendance = $this->attendance->groupBy('worker_id')[$workerId];
            $goCount = $attendance->where('absence_reason', AttendanceModel::ABSENCE_REASON_SICK_LEAVE)->count();
            return $goCount;
        }
        return 0;
    }

    private function getFieldICount($workerId){
        if(isset($this->attendance->groupBy('worker_id')[$workerId])){
            $attendance = $this->attendance->groupBy('worker_id')[$workerId];
            $field_1 = $attendance->where('type', 1)->count();
            return $field_1;
        }
        return 0;
    }

    private function getFieldIICount($workerId){
        if(isset($this->attendance->groupBy('worker_id')[$workerId])){
            $attendance = $this->attendance->groupBy('worker_id')[$workerId];
            $field_1 = $attendance->where('type', 2)->count();
            return $field_1;
        }
        return 0;
    }

    private function getFinalPayOut($workerId){
        $final =  $this->data[$workerId]['base'] + $this->data[$workerId]['bonus_field_1'] + $this->data[$workerId]['bonus_field_2'] +$this->data[$workerId]['bonus'];
        return $final;
    }

    private function getBonus($workerId){
        //check if worker can get bonus
        if($this->data[$workerId]['bo']>1){
            return 0;
        }else{
            return $this->bonus;
        }
    }

}
