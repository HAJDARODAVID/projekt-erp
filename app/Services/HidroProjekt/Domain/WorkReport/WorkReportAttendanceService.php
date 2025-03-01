<?php

namespace App\Services\HidroProjekt\Domain\WorkReport;

use App\Models\AttendanceCoOpModel;
use App\Models\WorkerModel;
use App\Models\AttendanceModel;
use Illuminate\Support\Facades\Auth;
use App\Services\HidroProjekt\Domain\Workers\Employes\AttendanceService;
use App\Services\HidroProjekt\Domain\Subcontractors\SubcontractorsAttendanceService;

class WorkReportAttendanceService{

    private $wdrID;
    private $attendance;
    
    public function __construct($wdrID = NULL)
    {
        $this->wdrID = $wdrID;
        $this->setAttendanceForWdr();
    }

    private function setAttendanceForWdr(){
        if($this->wdrID != NULL){
            return $this->attendance = AttendanceModel::where('working_day_record_id', $this->wdrID)->get();
        }
        return $this->attendance = NULL;
    }

    public function getAttendanceArrayForBde(){
        $array = [];
        foreach ($this->attendance as $att) {
            $array[$att->worker_id] = [
                'name' => WorkerModel::where('id', $att->worker_id)->first()->fullName,
                'hours' => $att->work_hours,
                'absence_reason' => $att->absence_reason,
                'gl' => $att->worker_id == Auth::user()->worker_id ? TRUE : FALSE,
            ];
        }
        return $array;
    }

    public function countAllWorkersInAttendance(){
        $attService = new AttendanceService($this->wdrID); //countWorkersInAttendance
        $attSubConst = new SubcontractorsAttendanceService($this->wdrID);

        $count = $attService->countWorkersInAttendance() + $attSubConst->countWorkersInAttendance();
        return $count;
    }

    public function removeAllFromAttendance(){
        foreach ($this->attendance as $att) {
            $att->delete();
        }
        //HOTFIX: remove all SubContractors from attendance
        $sub = AttendanceCoOpModel::where('working_day_record_id',$this->wdrID)->get(); 
        foreach ($sub as $att) {
            $att->delete();
        }
        return $this;
    }

    public function updateAllAttendance($data=[]){
        $columnDB = [
            'work_type' => 'type',
            'date' => 'date',
        ];
        if(array_key_exists($data['colName'], $columnDB)){
            if($columnDB[$data['colName']] == 'type'){
                foreach ($this->attendance as $att) {
                    if($att->type != NULL){
                        $att->update([
                            $columnDB[$data['colName']] => $data['value'],
                        ]);
                    }
                }
                return;
            }
            foreach ($this->attendance as $att) {
                $att->update([
                    $columnDB[$data['colName']] => $data['value'],
                ]);
            }
        }
    }
}