<?php

namespace App\Http\Controllers\HidroProjekt;

use Illuminate\Http\Request;
use App\Models\CompanyCarsModel;
use Jenssegers\Agent\Facades\Agent;
use App\Http\Controllers\Controller;

class AssetsController extends Controller
{
    public function companyCars(){
        return view('hidro-projekt.ASSETS.companyCars');
    }

    public function addCompanyCars(Request $request){
        $validation = $request->validate([
            'car_plates' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'valid_to' => 'required',
         ]);
         CompanyCarsModel::create($request->all());
         return redirect()->route('hp_companyCars')->with('success', 'Vozilo uspješno dodano!');
    }

    public function showCompanyCar($plates){
        $isPhone = Agent::isPhone();
        $carInfo = CompanyCarsModel::where('car_plates', $plates)->where('active', TRUE)->first();
        return view('hidro-projekt.ASSETS.showCompanyCar', [
            'carInfo' => $carInfo,
            'isPhone' => $isPhone,
        ]);
    }
}
