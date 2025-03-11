<?php

namespace App\Services\HidroProjekt\Domain\JobSite;

use App\Models\StorageStockItem;
use App\Models\AppParametersModel;
use App\Models\MaterialMasterData;
use App\Models\ConstructionSiteModel;
use App\Models\WorkingDayRecordModel;
use App\Models\MaterialConsumptionModel;

class JobSiteService{

    private $jobSiteOBJ;
    private $materialOnStock = NULL;
    private $consumedMaterials = NULL;

    public function __construct($jobSiteID = NULL)
    {
        $this->jobSiteOBJ = $jobSiteID != NULL ? $this->setJobSite($jobSiteID): NULL;
        $this->setMaterialsOnStock()->setConsumedMaterials();
    }

    private function setJobSite($jobSiteID){
        return ConstructionSiteModel::where('id', $jobSiteID);
    }

    public function setMaterialsOnStock(){
        if($this->jobSiteOBJ){
            $this->materialOnStock = StorageStockItem::where('str_loc', 40000)
                ->where('cons_id', $this->jobSiteOBJ->first()->id)
                ->where('qty', '>', 0)
                ->with('getMaterialInfo');
        }
        return $this;
    }

    public function setConsumedMaterials(){
        if($this->jobSiteOBJ){
            $wdr = WorkingDayRecordModel::where('construction_site_id', $this->jobSiteOBJ->first()->id)->pluck('id')->toArray();
            $this->consumedMaterials = MaterialConsumptionModel::whereIn('wdr_id', $wdr)->with('getConsumptionItems');
        }
        return $this;
    }

    public function materialToArray(){
        $array = [];
        foreach ($this->getMaterialsOnStock() as $mat) {
            $array[$mat->mat_id] = [
                'qty' => $mat->qty,
            ];
        }
        return $array;
    }

    public function getConsumedMaterialsForWdrArray($wdrID){
        $array = [];
        $wdrConsumptions = $this->consumedMaterials->where('wdr_id', $wdrID)->get();
        foreach ($wdrConsumptions as $item) {
            foreach ($item->getConsumptionItems as $consumption) {
                $array[] = [
                    'mat' => MaterialMasterData::where('id', $consumption->mat_id)->first()->name,
                    'qty' => $consumption->qty,
                    'time' => $consumption->created_at,
                ];
            }
        }
        $newArray = [];
        foreach ($array as $a){
            if(isset($newArray[$a['mat']])){
                $newArray[$a['mat']] = $newArray[$a['mat']] + $a['qty'];
            }else{
                $newArray[$a['mat']] = $a['qty'];
            }
        }
        return $newArray;
    }

    public function getMaterialsOnStock(){
        return $this->materialOnStock->get();
    }

    public function geJobSiteInfo(){
        return $this->jobSiteOBJ->first();
    }

    public function getAllJobSites(){
        return ConstructionSiteModel::where('status', ConstructionSiteModel::CONSTRUCTION_STATUS_ACTIVE)->get();
    } 

    public function getJobSitesById(array $id){
        return ConstructionSiteModel::whereIn('id', $id)->get();
    } 

    public function getCarCostForConstSite(){
        $workHourCost= (float)AppParametersModel::where('param_name_srt', 'bwcc')->where('active', TRUE)->first()->value;
        $wdrAll = WorkingDayRecordModel::where('construction_site_id', $this->jobSiteOBJ->first()->id)
            ->with('getCarMileage')->get();
        $carMileage = 0;
        foreach ($wdrAll as $wdr) {
            foreach ($wdr->getCarMileage as $car) {
                if(!is_null($car->start_mileage) && !is_null($car->end_mileage)){
                    $carMileage += $car->end_mileage - $car->start_mileage;
                }
            }
        }
        $array['carCost'] = $carMileage * $workHourCost;
        return $array;
    }
}