<?php

namespace App\Livewire\HidroProjekt\Assets;

use App\Services\HidroProjekt\ASSETS\CompanyCarService;
use Livewire\Component;

class CarInfoInputBoxes extends Component
{
    public $carInfo;
    public $mileage;

    public function mount(){
        $this->mileage = $this->getCarMileage();
    }

    public function updatedCarInfo($key, $value){
        $service = new CompanyCarService;
        $service->updateCompanyCar($this->carInfo['id'], [
            $value => $key,
        ]);
    }

    private function getCarMileage(){
        $service = new CompanyCarService;
        return $service->getCarsLastMileage($this->carInfo['id'],'*');
    }

    public function render()
    {
        return view('livewire.hidroprojekt.assets.car-info-input-boxes');
    }
}
