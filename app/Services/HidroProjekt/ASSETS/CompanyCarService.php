<?php

namespace App\Services\HidroProjekt\ASSETS;

use stdClass;
use App\Models\CarMileageModel;
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

    public function getCarsLastMileage($id, $wdrId){
        $carMileage = CarMileageModel::where('car_id', $id)
                        ->where('wdr_id', '!=', $wdrId)
                        ->orderBy('id', 'desc')
                        ->take(5)
                        ->get();
        $lastMileage = 0;
        foreach ($carMileage as $info) {
            if(!is_null($info->end_mileage)){
                $lastMileage= $info->end_mileage;
                break;
            }
        }
        return $lastMileage;
    }

    public function getCarsLastMileageInfoForWdr($wdrId,$carId){
        return  CarMileageModel::where('wdr_id', $wdrId)->where('car_id', $carId)->first();
    }

    public function updateCarMileage($wdrId, $data){
        $wdrObj = CarMileageModel::where('wdr_id', $wdrId)->first();
        if(!is_null($wdrObj)){
            if(isset($data['delete']) && $data['delete']){
                return $wdrObj->delete();
            }else{
                return $wdrObj->update($data);
            }
        }else{
            $data['wdr_id'] = $wdrId;
            return CarMileageModel::create($data);
        }
    }

}
