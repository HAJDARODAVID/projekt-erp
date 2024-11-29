<?php

namespace App\Services\HidroProjekt\Domain\JobSite;

use App\Models\ConstructionSiteModel;
use App\Models\StorageStockItem;

class JobSiteService{

    private $jobSiteOBJ;
    private $materialOnStock = NULL;

    public function __construct($jobSiteID = NULL)
    {
        $this->jobSiteOBJ = $jobSiteID != NULL ? $this->setJobSite($jobSiteID): NULL;
        $this->setMaterialsOnStock();
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

    public function materialToArray(){
        $array = [];
        foreach ($this->getMaterialsOnStock() as $mat) {
            $array[$mat->mat_id] = [
                'qty' => $mat->qty,
            ];
        }
        return $array;
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
}