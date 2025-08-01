<?php

namespace App\Services\Assets;

use App\Models\CompanyCarsModel;

/**
 * Class AllCompanyCarsService.
 */
class AllCompanyCarsService
{
    /**
     * This will give you the Company cars plates and id.
     * Use this for all selection tags.
     * @return array
     */
    public static function getCarsForSelection(): array
    {
        return CompanyCarsModel::where('active', CompanyCarsModel::COMPANY_CAR_STATUS_ACTIVE)->pluck('car_plates', 'id')->toArray();
    }
}
