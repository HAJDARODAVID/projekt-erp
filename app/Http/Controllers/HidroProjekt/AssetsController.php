<?php

namespace App\Http\Controllers\HidroProjekt;

use Illuminate\Http\Request;
use Intervention\Image\Image;
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

    public function uploadCarAvatarImage(Request $request){

        if($request->hasFile('carAvatarFolder')){
            $fileName = time() . '-' . $request->plates . '.' . $request->file('carAvatarFolder')->getClientOriginalExtension();
            $request->carAvatarFolder->move(public_path('images/assets/cars/'), $fileName);
            CompanyCarsModel::where('id',$request->carId)->update([
                'avatar' => $fileName
            ]);
            return redirect()->route('hp_showCompanyCar', $request->plates);
        }
        if($request->hasFile('carAvatarCamera')){
            $fileName = time() . '-' . $request->plates . '.' . $request->file('carAvatarCamera')->getClientOriginalExtension();
            $request->carAvatarCamera->move(public_path('images/assets/cars/'), $fileName);
            CompanyCarsModel::where('id',$request->carId)->update([
                'avatar' => $fileName
            ]);
            return redirect()->route('hp_showCompanyCar', $request->plates);
        }

        // $fileName = time() .'-'.$plates.'.' . $request->file('carAvatarFolder')->getClientOriginalExtension();
        // dd($fileName);
        // $request->image->storeAs('public/images', $fileName);
    }
}
