<?php

namespace App\Livewire\HidroProjekt\Assets;

use App\Services\HidroProjekt\ASSETS\CompanyCarService;
use Livewire\Component;

class CarInfoInputBoxes extends Component
{
    public $carInfo;

    // public function mount(){
    //     dd($this->carInfo);
    // }

    public function updatedCarInfo($key, $value){
        $service = new CompanyCarService;
        $service->updateCompanyCar($this->carInfo['id'], [
            $value => $key,
        ]);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.assets.car-info-input-boxes');
    }
}
