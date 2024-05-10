<?php

namespace App\Livewire\HidroProjekt\Bde;

use App\Models\WorkingDayRecordModel;
use App\Services\HidroProjekt\BDE\ConsumptionService;
use App\Services\HidroProjekt\STG\MovementService;
use App\Services\HidroProjekt\STG\MovementTypes;
use App\Services\HidroProjekt\STG\StorageLocation;
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
        //Get construction site ID
        $consSiteId= WorkingDayRecordModel::where('id', $this->wdr)->first();
        $consSiteId = $consSiteId->construction_site_id;
        //call to the consumption method
        $service = new ConsumptionService;
        $service->sendItemsToConsumption($this->wdr,$this->onStock,$consSiteId);
        //Remove all items
        unset($this->items);
        //Refresh page
        return redirect()->route('hp_consSiteMaterialConsumption', $this->wdr);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-consumption-table-component');
    }
}
