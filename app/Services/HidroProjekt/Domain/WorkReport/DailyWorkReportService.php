<?php

namespace App\Services\HidroProjekt\Domain\WorkReport;

use App\Models\WorkingDayLogModel;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkingDayRecordModel;

class DailyWorkReportService{

    const WDR_TYPE_NO_WD_REPORT = 4;

    private $user;
    private $constSite;
    private $date;
    private $wdrId;

    private $wdrObj;

    public function __construct(
        $constSite = NULL,
        $date      = NULL,
    )
    {
        $this->user      = Auth::user()->id;
        $this->constSite = $constSite;
        $this->date      = $date == NULL ? date('Y-m-d') : $date;
    }

    public function createNewWorkReportItem($car=NULL, $remark = NULL, $type = NULL){
        $this->wdrObj = WorkingDayRecordModel::create([
                            'user_id'              => $this->user,
                            'construction_site_id' => $this->constSite,
                            'car_id'               => $car,
                            'date'                 => $this->date,
                            'work_type'            => $type,
                            'work_description'     => $remark
                        ]);
        return $this;
    }

    public function createNewWOrkReportLog($log){
        WorkingDayLogModel::create([
            'working_day_record_id' => $this->wdrObj->id,
            'construction_site_id' => $this->wdrObj->construction_site_id,
            'log' => $log,
        ]);
        return $this;
    }

    public function findById($dwrId){
        $this->wdrObj = WorkingDayRecordModel::where('id', $dwrId)->first();
        return $this;
    }

    public function getAllReportsForCs(){
        $this->wdrObj = WorkingDayRecordModel::where('construction_site_id', $this->constSite);
        return $this;
    }

    public function isEmpty(){
        return $this->wdrObj->get()->isEmpty();
    }

    public function getLastReport(){
        return $this->wdrObj->orderBy('id', 'desc')->first();
    }
}