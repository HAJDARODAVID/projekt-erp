<?php

namespace App\Services\HidroProjekt\ASSETS;

use App\Models\CompanyCarsModel;

/**
 * Class CompanyCarService.
 */
class CompanyCarService
{

    public function updateCompanyCar($id, $data){
        CompanyCarsModel::where('id', $id)
            ->update($data);
        return;
    }

    public function getCarById($id){
        return CompanyCarsModel::where('id', $id)->first();
    }

}
