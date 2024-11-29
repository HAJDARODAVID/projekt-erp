<?php

namespace App\Livewire\Domain\Bde\MainWorkReportModules\Consumption;

use App\Services\HidroProjekt\Domain\JobSite\JobSiteService;
use Livewire\Component;

class Consumption extends Component
{
    public $wdr;
    public $onStock;
    public $items = [];
    public $saveState = [];

    public function mount(){
        $service = new JobSiteService($this->wdr['construction_site_id']);
        $this->onStock = $service->getMaterialsOnStock();
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

    public function render()
    {
        return view('livewire.domain.bde.main-work-report-modules.consumption.consumption');
    }
}
