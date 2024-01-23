<?php

namespace App\Livewire\HidroProjekt\Wp;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\ConstructionSiteModel;
use App\Services\HidroProjekt\WP\ConstructionSiteService;

class ChangeHeaderNameInputBox extends Component
{
    public $headerName;
    public $headerId;
    private $constSiteService;

    public function mount($headerName,$headerId){
        $this->headerName = $headerName;
        $this->headerId = $headerId;
        $this->constSiteService = new ConstructionSiteService;
    }

    public function updatedHeaderName(){
        $this->constSiteService = new ConstructionSiteService;
        if($this->headerName == ""){
            return;
        }else{
            $this->constSiteService->updateConstructionSite(2,[
                'name' => $this->headerName
            ]);
        }
    }

    public function render()
    {
        return view('livewire.hidroprojekt.wp.change-header-name-input-box');
    }
}
