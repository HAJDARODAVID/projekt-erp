<?php

namespace App\Livewire\Domain\Bde\MainWorkReportModules\Consumption;

use App\Services\HidroProjekt\Domain\JobSite\JobSiteService;
use App\Services\HidroProjekt\Domain\Material\MaterialMovementService;
use App\Services\HidroProjekt\Domain\Material\MovementTypes;
use Livewire\Component;

class Consumption extends Component
{
    public $wdr;
    public $onStock;
    public $consumedMaterial;
    public $items = [];
    public $saveState = [];
    public $consumptionStatus = FALSE;

    public function mount(){
        $service = new JobSiteService($this->wdr['construction_site_id']);
        $this->onStock = $service->getMaterialsOnStock();
        $this->consumedMaterial = $service->getConsumedMaterialsForWdrArray($this->wdr['id']);
    }

    public function updatedItems($key, $value){
        $this->reset('saveState');
        $jobService = new JobSiteService($this->wdr['construction_site_id']);
        //restore qty to max if 2-mač
        if($key > $jobService->materialToArray()[$value]['qty']){
            $this->items[$value] = $jobService->materialToArray()[$value]['qty'];
        }
        $this->saveState[$value] = TRUE;
    }

    private function convertItemsForConsumption(){
        $array = [];
        foreach ($this->items as $key => $qty) {
            $array[] = [
                'mat_id' => $key,
                'qty' => $qty,
            ];
        }
        return $array;
    }

    public function sendToConsumption(){
        $this->reset('saveState');
        $items = $this->convertItemsForConsumption();
        $service = new MaterialMovementService(MovementTypes::BOOK_TO_CONSUMPTION,$items,$this->wdr['construction_site_id'], $this->wdr['id']);
        $service->consumer();
        $JSservice = new JobSiteService($this->wdr['construction_site_id']);
        $this->onStock = $JSservice->getMaterialsOnStock();
        $this->consumedMaterial = $JSservice->getConsumedMaterialsForWdrArray($this->wdr['id']);
        $this->items = [];
        $this->consumptionStatus = TRUE;
    }

    public function render()
    {
        return view('livewire.domain.bde.main-work-report-modules.consumption.consumption');
    }
}
