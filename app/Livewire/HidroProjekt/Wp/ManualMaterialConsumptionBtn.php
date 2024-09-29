<?php

namespace App\Livewire\HidroProjekt\Wp;

use App\Models\ConstructionSiteModel;
use App\Models\MaterialMasterData;
use Livewire\Component;

class ManualMaterialConsumptionBtn extends Component
{
    public $modalShow = FALSE;
    public $constructionSiteInfo;
    public $materialInfo;
    public $qty;
    public $row;

    public function mount(){
        $this->constructionSiteInfo = ConstructionSiteModel::where('id', $this->row->cons_id)->first();
        $this->materialInfo = MaterialMasterData::where('id', $this->row->mat_id)->first();
        $this->qty = $this->row->qty;
    }

    public function sendMaterialToConsumption(){
        
    }

    public function modalToggle(){
        if($this->modalShow){
            return $this->modalShow = FALSE;
        }else{
            return $this->modalShow = TRUE;
        }
    }
    public function render()
    {
        return view('livewire.hidroprojekt.wp.manual-material-consumption-btn');
    }
}
