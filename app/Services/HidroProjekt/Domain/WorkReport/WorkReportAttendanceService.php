<?php

namespace App\Services\HidroProjekt\Domain\WorkReport;

use App\Models\WorkerModel;
use App\Models\AttendanceModel;
use Illuminate\Support\Facades\Auth;

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
}