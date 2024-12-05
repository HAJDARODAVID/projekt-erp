<?php

namespace App\Services\HidroProjekt\Domain\CompanyFleet;

use App\Models\CarMileageModel;
use App\Models\CompanyCarsModel;

class CompanyVanService{

    private $vehicle;
    private $milageReport;

    public function __construct($id = NULL)
    {
        $this->vehicle = $id != NULL ? CompanyCarsModel::where('id', $id)->first() : NULL;
    }

    public function getLastMileage(){
        $mileage = CarMileageModel::where('car_id', $this->vehicle->id)->where('end_mileage', '!=', NULL)->orderBy('id', 'desc')->first();
        return $mileage != NULL ? $mileage->end_mileage : NULL;
    }

    public function getAllActiveCompanyVans(){
        return CompanyCarsModel::where('active', CompanyCarsModel::COMPANY_CAR_STATUS_ACTIVE)->get();
    }

    public function getMileageForWorkReport($wdr_id){
        $mileages = CarMileageModel::where('wdr_id', $wdr_id)->first();
        return $mileages;
    }

    public function createNewMilageReport($wdr_id, $start_mileage=NULL, $end_mileage=NULL){
        $newMilageReport  = CarMileageModel::create([
                                'car_id'        => $this->vehicle->id,
                                'wdr_id'        => $wdr_id,
                                'start_mileage' => $start_mileage,
                                'end_mileage'   => $end_mileage,
        ]);
        $this->milageReport = $newMilageReport;
        return $newMilageReport;
    }

    public function hasMilageReport($wdr_id){
        $report = CarMileageModel::where('wdr_id', $wdr_id)->where('car_id', $this->vehicle->id)->first();
        if(is_null($report)){
            return FALSE;
        }
        $this->milageReport = $report;
        return TRUE;
    }

    public function getMilageReport(){
        return $this->milageReport;
    }

}