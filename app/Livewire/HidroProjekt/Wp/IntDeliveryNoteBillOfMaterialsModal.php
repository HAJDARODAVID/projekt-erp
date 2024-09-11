<?php

namespace App\Livewire\HidroProjekt\Wp;

use App\Models\ConstructionSiteModel;
use App\Models\MaterialDocModel;
use App\Models\MaterialMvtModel;
use App\Services\HidroProjekt\STG\MovementTypes;
use Livewire\Component;

class IntDeliveryNoteBillOfMaterialsModal extends Component
{
    public $row;
    public $matDoc;
    public $activeModal = FALSE;
    public $deliveryNoteBOM;
    public $bookingType;
    public $constSite;
    public $overAllValue;
    public $error = [];

    public function mount(){
        //dd($this->row);
        $this->matDoc          = $this->getMaterialDoc();
        $this->deliveryNoteBOM = $this->getBillOfMaterials();
        $this->constSite       = $this->getConstructionSite();
        $this->overAllValue    = $this->getOverAllValue();
        $this->bookingType     = MovementTypes::MVT_DESC_HR[$this->row->mvt_type];
        //dd($this->deliveryNoteBOM);
    }

    public function modalBtn($type){
        if($type==0){
        }
        return $this->activeModal = $type;
    }

    private function getBillOfMaterials(){
        return MaterialMvtModel::where('mat_doc_id', $this->row->id)->where('const_id', "!=", NULL)->with('getMaterialInfo')->get();
    }

    private function getMaterialDoc(){
        return MaterialDocModel::where('id', $this->row->id)->with('getUserInfo','getUserInfo.getWorker')->first();
    }

    private function getConstructionSite(){
        if($this->deliveryNoteBOM->isEmpty()){
            $this->error[] = 'There are no materials listed in MatDoc: ' . $this->matDoc->id;
            return NULL;
        }
        $constSite = ConstructionSiteModel::where('id', $this->deliveryNoteBOM->pluck('const_id')->unique('const_id')->toArray()[0])->first();
        
        return $constSite;
    }

    private function getOverAllValue(){
        $value=0;
        foreach ($this->deliveryNoteBOM as $bom) {
            $value += $bom->qty * $bom->getMaterialInfo->price;
        }
        return $value;
    }

    public function showError(){
        return $this->dispatch('show-alert-modal', [
            'title' => 'ERROR!',
            'message' => $this->error[0],
            'type' => 'danger',
        ]);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.wp.int-delivery-note-bill-of-materials-modal');
    }
}
