<?php

namespace App\Http\Controllers\HidroProjekt;

use App\Http\Controllers\Controller;
use App\Models\MaterialMasterData;
use App\Models\Supplier;
use App\Models\UnitOfMeasure;
use Illuminate\Http\Request;

class MaterialMasterDataController extends Controller
{
    public function masterMaterial(){
        return view('hidro-projekt.ADM.masterMaterials');
    }

    public function createNewMaterialForm(){
        return view('hidro-projekt.ADM.newMaterial',[
            'uom'       => UnitOfMeasure::UOM,
            'suppliers' => Supplier::get(),
        ]);
    }

    public function showMaterial($id){
        $mmInfo = MaterialMasterData::find($id);
        return view('hidro-projekt.ADM.showMaterial',[
            'uom'       => UnitOfMeasure::UOM,
            'mmInfo'    => $mmInfo,
            'suppliers' => Supplier::get(),
        ]);
    }
}
