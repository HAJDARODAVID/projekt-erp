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
}
