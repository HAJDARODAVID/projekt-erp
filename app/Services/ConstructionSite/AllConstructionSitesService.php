<?php

namespace App\Services\ConstructionSite;

use App\Models\ConstructionSiteModel;

/**
 * Class AllConstructionSitesService.
 */
class AllConstructionSitesService
{

    /**
     * This will give you the Construction sites names and id.
     * Use this for all selection tags.
     * @return array
     */
    public static function getSitesForSelection(): array
    {
        $array = ConstructionSiteModel::where('status', ConstructionSiteModel::CONSTRUCTION_STATUS_ACTIVE)->pluck('name', 'id')->toArray();
        asort($array);
        return $array;
    }
}
