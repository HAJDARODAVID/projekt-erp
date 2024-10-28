<?php

namespace App\Services\HidroProjekt\Domain\Workers\Employes;

use App\Models\AttendanceModel;
use App\Models\User;

class AttendanceService
{   
    private $wdrId;
    private $type;
    private $date;

    public function __construct(
        $wdrId = NULL,
        $type  = NULL,
        $date  = NULL,
    )
    {
        $this->wdrId = $wdrId;
        $this->type  = $type;
        $this->date  = $date;
    }

    public function createNewWorkHoursAttendance($worker, $hours){
        $att = AttendanceModel::create([
            'worker_id'             => $worker,
            'working_day_record_id' => $this->wdrId,
            'type'                  => $this->type,
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
}