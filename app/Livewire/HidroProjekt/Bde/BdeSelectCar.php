<?php

namespace App\Livewire\Hidroprojekt\Bde;

use App\Models\CompanyCarsModel;
use Livewire\Component;

class BdeSelectCar extends Component
{
    public $cars;
    public $selectedCar = NULL;
    public $record;

    public function mount(){
        $this->cars = CompanyCarsModel::get();
    }
    public function updatedSelectedCar(){
        if($this->selectedCar == 0){
            $this->record->update([
                'car_id' => NULL,
            ]);
        }else{
            $this->record->update([
                'car_id' => $this->selectedCar,
            ]);
        }
        
    }
    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-select-car');
    }
}
