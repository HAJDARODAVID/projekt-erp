<?php

namespace App\Services\HidroProjekt\ADM;

use Exception;
use App\Models\WorkerModel;
use App\Models\AttendanceModel;
use App\Models\AppParametersModel;
use App\Models\PayrollBasicInfoModel;
use App\Models\PayrollModel;

/**
 * Class PayrollAccountingService.
 */
class PayrollAccountingService
{
    protected $month;
    protected $year;
    protected $attendance;
    protected $dataFromUser;
    protected $payroll;

    public $data = [];
    public $field_1;
    public $field_2;
    public $bonus;
    

    public function __construct($month, $year, $dataFromUser = NULL){
        $this->month        = $month;
        $this->year         = $year;
        $this->dataFromUser = $dataFromUser;
        $this->attendance   = $this->getAttendance();
        $this->payroll      = $this->getPayrollDataFromTable();
        $this->field_1      = AppParametersModel::where('param_name_srt', 'adm-fwb-home')->pluck('value')->first();
        $this->field_2      = AppParametersModel::where('param_name_srt', 'adm-fwb-field')->pluck('value')->first();
        $this->bonus        = AppParametersModel::where('param_name_srt', 'adm-wb')->pluck('value')->first();

        //$this->execute();
    }

    public function execute(){
        //Get all workers to property data
        $this->data = $this->getAllWorkersForPayroll();
        //Fill workers with data
        foreach ($this->data as $key => $worker) {
            $this->data[$key]['fix_rate']      = $this->getFixRate($key);
            $this->data[$key]['h_rate']        = $this->getHRate($key);
            $this->data[$key]['hours']         = $this->getWorkerHours($key);
            $this->data[$key]['go']            = $this->getPaidLeaveCount($key);
            $this->data[$key]['bo']            = $this->getSickLeaveCount($key);
            $this->data[$key]['field_1']       = $this->getFieldICount($key);
            $this->data[$key]['field_2']       = $this->getFieldIICount($key);
            $this->data[$key]['base']          = $this->getBase($key);
            $this->data[$key]['bonus_field_1'] = $this->data[$key]['field_1'] * $this->field_1;
            $this->data[$key]['bonus_field_2'] = $this->data[$key]['field_2'] * $this->field_2;
            $this->data[$key]['bonus']         = $this->getBonus($key);
            $this->data[$key]['travel_exp']    = $this->getTravelExp($key);
            $this->data[$key]['phone_exp']     = $this->getPhoneExp($key);
            $this->data[$key]['pay_out']       = $this->getFinalPayOut($key);
        }
        return;
    }

    private function getHRate($workerId){
        $h_rate = PayrollBasicInfoModel::where('worker_id', $workerId)->first();
        if(!is_null($h_rate)){
            $h_rate = is_null($h_rate->h_rate) ? 0 : $h_rate->h_rate;
            return (float)$h_rate;
        }
        return (float)0;
    }

    private function getBase($id){
        if($this->data[$id]['fix_rate']){
            return (float)$this->data[$id]['fix_rate'];
        }
        return (float)($this->data[$id]['hours'] * $this->data[$id]['h_rate']);
    }

    private function getAllWorkersForPayroll(){
        //Get active workers
        $activeWorkersModel = WorkerModel::where('status', 1)->get();
        $workerArray = [];
        foreach ($activeWorkersModel as $worker) {
            $workerArray[$worker->id] = [
                'fullName' => $worker->fullName,
                'is_worker' => $worker->is_worker,
            ];
        }
        //Get workers who are not with us anymore :(
        foreach ($this->attendance->groupBy('worker_id') as $key => $att) {
            if(!array_key_exists($key, $workerArray)){
                $oldWorker = WorkerModel::where('id', $key)->first();
                $workerArray[$oldWorker->id] = [
                    'fullName' => $oldWorker->fullName,
                    'is_worker' => $oldWorker->is_worker,
                ];
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
            return (float)($hoursSum + ($this->getPaidLeaveCount($workerId)*8));
        }
        return (float)0;
    }

    private function getPaidLeaveCount($workerId){
        if(isset($this->attendance->groupBy('worker_id')[$workerId])){
            $attendance = $this->attendance->groupBy('worker_id')[$workerId];
            $goCount = $attendance->where('absence_reason', AttendanceModel::ABSENCE_REASON_PAID_LEAVE)->count();
            return (float)$goCount;
        }
        return (float)0;
    }

    private function getSickLeaveCount($workerId){
        if(isset($this->attendance->groupBy('worker_id')[$workerId])){
            $attendance = $this->attendance->groupBy('worker_id')[$workerId];
            $goCount = $attendance->where('absence_reason', AttendanceModel::ABSENCE_REASON_SICK_LEAVE)->count();
            return (float)$goCount;
        }
        return (float)0;
    }

    private function getFieldICount($workerId){
        if(isset($this->attendance->groupBy('worker_id')[$workerId])){
            $attendance = $this->attendance->groupBy('worker_id')[$workerId];
            $field_1 = $attendance->where('type', 1)->count();
            return (float)$field_1;
        }
        return (float)0;
    }

    private function getFieldIICount($workerId){
        if(isset($this->attendance->groupBy('worker_id')[$workerId])){
            $attendance = $this->attendance->groupBy('worker_id')[$workerId];
            $field_1 = $attendance->where('type', 2)->count();
            return (float)$field_1;
        }
        return (float)0;
    }

    private function getFinalPayOut($workerId){
        // if($this->getFixRate($workerId)){
        //     return $this->getFixRate($workerId);
        // }
        $final =  $this->data[$workerId]['base'] + $this->data[$workerId]['bonus_field_1'] + $this->data[$workerId]['bonus_field_2'] +$this->data[$workerId]['bonus']+$this->data[$workerId]['travel_exp']+$this->data[$workerId]['phone_exp'];
        return (float)$final;
    }

    private function getFixRate($workerId){
        $fix = PayrollBasicInfoModel::where('worker_id', $workerId)->first();
        if(!is_null($fix)){
            if(!is_null($fix->fix_rate)){
                return (float)$fix->fix_rate;
            }else{
                return FALSE;
            }
        }
        return FALSE;
    }

    private function getBonus($workerId){
        //check if worker can get bonus
        try {
            if($this->data[$workerId]['bo']>0){
                return (float)0;
            }else{
                if($this->getIfWorkerCanGetBonus($workerId)){
                    return $this->bonus;
                }
                return (float)0;
            }
        } catch (Exception $e) {
            dd($e, $workerId);
        }
    }

    private function getIfWorkerCanGetBonus($workerId){
        $bonus = PayrollBasicInfoModel::where('worker_id', $workerId)->first();
        if(!is_null($bonus)){
            return $bonus->bonus;
        }
        return FALSE;
    }

    private function getTravelExp($workerId){
        $travelExp = PayrollBasicInfoModel::where('worker_id', $workerId)->first();
        if(!is_null($travelExp)){
            return (float)$travelExp->travel_exp;
        }
        return (float)0;
    }

    private function getPhoneExp($workerId){
        $phoneExp = PayrollBasicInfoModel::where('worker_id', $workerId)->first();
        if(!is_null($phoneExp)){
            return (float)$phoneExp->phone_exp;
        }
        return (float)0;
    }

    static public function updateRate(){
        return;
    }

    protected function getPayrollDataFromTable(){
        return PayrollModel::where('month', $this->month)->where('year', $this->year)->with('getPayrollItems')->first();
    }

    public function getPayroll(){
        return $this->payroll;
    }
    

}
