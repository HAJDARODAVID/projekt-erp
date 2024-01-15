<?php

namespace App\Livewire\Hidroprojekt;

use App\Models\CompanyCarsModel;
use Livewire\Component;

class BdeSelectCar extends Component
{
    public $cars;
    public $selectedCar;

    public function mount(){
        $this->cars = CompanyCarsModel::get();
    }
    public function render()
    {
        return view('livewire.hidroprojekt.bde-select-car');
    }
}
