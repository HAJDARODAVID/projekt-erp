<?php

namespace App\Http\Controllers\HidroProjekt;

use App\Http\Controllers\Controller;
use App\Models\CompanyCarsModel;
use Illuminate\Http\Request;

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
        dd($plates);
    }
}
