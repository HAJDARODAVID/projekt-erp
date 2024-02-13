<?php

namespace App\Livewire\HidroProjekt\Bde;

use App\Models\CompanyCarsModel;
use App\Services\HidroProjekt\ASSETS\CompanyCarService;
use Livewire\Component;

class BdeSelectCar extends Component
{
    public $cars;
    public $selectedCar = NULL;
    public $record;
    public $showMileage;
    public $mileage = [
        'start' => 0,
        'end' => 0,
    ];
    public $endMilageError = FALSE;

    public function mount(){
        $this->cars = CompanyCarsModel::get();
        $this->showMileage = $this->selectedCar == NULL ? FALSE : TRUE;
        $this->setMileageData();
    }
    public function updatedSelectedCar(){
        if($this->selectedCar == 0){
            $this->record->update([
                'car_id' => NULL,
            ]);
            $this->updateMileageEntry(delete:TRUE);
            $this->showMileage = FALSE;
        }else{
            $this->record->update([
                'car_id' => $this->selectedCar,
            ]);
            $this->showMileage = TRUE;
            $this->updateMileageEntry(delete:TRUE);
            $this->setMileageData();
        }     
    }

    public function updatedMileage($key, $value){
        $this->updateMileageEntry(data:[
            'car_id' => $this->selectedCar,
            'start_mileage' => $this->mileage['start'],
            'end_mileage' => $this->mileage['end'],
        ] );
        //
        //dd($keyString);
    }

    private function setMileageData(){
        $carMileageService = new CompanyCarService;
        $lastMileage = $carMileageService->getCarsLastMileage($this->selectedCar, $this->record->id);
        $lastMileageWdr = $carMileageService->getCarsLastMileageInfoForWdr($this->record->id,$this->selectedCar);
        if(is_null($lastMileageWdr)){
            return $this->mileage = [
                'start' => $lastMileage,
                'end' => 0,
            ];
        }else{
            return $this->mileage = [
                'start' => $lastMileageWdr->start_mileage,
                'end' => $lastMileageWdr->end_mileage,
            ];
        }
    }

    private function updateMileageEntry($delete=false, $data=[]){
        $carMileageService = new CompanyCarService;
        if($delete){
            return $carMileageService->updateCarMileage($this->record->id, ['delete'=>TRUE]);
        }else{
            return $carMileageService->updateCarMileage($this->record->id, $data);
        }
        

    }

    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-select-car');
    }
}
