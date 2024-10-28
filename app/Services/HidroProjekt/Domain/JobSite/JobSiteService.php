<?php

namespace App\Services\HidroProjekt\Domain\JobSite;

use App\Models\ConstructionSiteModel;

class JobSiteService{

    public function getAllJobSites(){
        return ConstructionSiteModel::where('status', ConstructionSiteModel::CONSTRUCTION_STATUS_ACTIVE)->get();
    } 
}