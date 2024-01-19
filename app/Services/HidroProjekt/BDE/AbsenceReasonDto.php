<?php

namespace App\Services\HidroProjekt\BDE;

use App\Models\AttendanceModel;

class AbsenceReasonDto {

    private $reasonId;

    public function __construct($reasonId)
    {
        $this->reasonId = $reasonId;
    }

    public function getReasonId(){
        return $this->reasonId;
    }

    public function getReasonDescription(){
        return AttendanceModel::ABSENCE_REASON[$this->reasonId];
    }

    public function getReasonShtTxt(){
        return AttendanceModel::ABSENCE_REASON_SHT_TXT[$this->reasonId];
    }
}