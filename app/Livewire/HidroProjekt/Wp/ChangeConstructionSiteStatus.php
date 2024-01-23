<?php

namespace App\Livewire\HidroProjekt\Wp;

use Livewire\Component;
use App\Models\ConstructionSiteModel;
use App\Services\HidroProjekt\WP\ConstructionSiteService;

class ChangeConstructionSiteStatus extends Component
{
    public $status;
    public $constId;
    public $allStatuses;
    private $constSiteService;

    public function mount($status, $constId){
        $this->status = $status;
        $this->constId = $constId;
        $this->allStatuses = ConstructionSiteModel::CONSTRUCTION_STATUS;    
    }

    public function updatedStatus(){
        $this->constSiteService = new ConstructionSiteService;
        //dd($this->status, $this->constId);
        $this->constSiteService->updateConstructionSite($this->constId,[
            'status' => $this->status
        ]);
    //    ConstructionSiteModel::where('id', $this->constId)->update(['status' => $this->status]);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.wp.change-construction-site-status');
    }
}
