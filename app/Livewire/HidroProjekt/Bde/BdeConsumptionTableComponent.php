<?php

namespace App\Livewire\HidroProjekt\Bde;

use App\Services\HidroProjekt\BDE\ConsumptionService;
use Livewire\Component;

class BdeConsumptionTableComponent extends Component
{
    public $onStock;

    public $wdr;

    public $items = [];

    public function mount(){
        $this->items = ConsumptionService::getAllItemsInConsumption($this->wdr);
    }

    public function updatedItems($key,$value){
        $service = new ConsumptionService;
        $service->addToConsumption($this->wdr, $value, $key);
        unset($service);
        return;
    }

    public function sendToConsumption(){
        dd($this->onStock);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-consumption-table-component');
    }
}
