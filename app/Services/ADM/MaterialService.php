<?php

namespace App\Services\ADM;

use App\Models\MaterialMasterData;

/**
 * Class MaterialService.
 */
class MaterialService
{

    public function createNewMaterial($data){
        return MaterialMasterData::create($data);
    }

}
