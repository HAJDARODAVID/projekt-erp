<?php

namespace App\Services\HidroProjekt\WP;

use App\Models\ConstructionSiteModel;

/**
 * Class ConstructionSiteService.
 */
class ConstructionSiteService
{

    public static function addNewConstructionSites($request):void { 
        ConstructionSiteModel::create($request);
    }

    public function updateConstructionSite($id,$data):void{
        ConstructionSiteModel::where('id', $id)->update($data);
    }

    public function getConstructionSite($id){
        return ConstructionSiteModel::where('id', $id)->first();
    }
}
