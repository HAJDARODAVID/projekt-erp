<?php

namespace App\Livewire\HidroProjekt\Bde;

use Livewire\Component;
use App\Models\MaterialMasterData;
use App\Models\ConstructionSiteModel;

class BdeInternalOrderForm extends Component
{
    public $allCs;
    public $mmInfo;
    public $selectedCs = 4;
    public $items = [];
    public $error = [];

    public function mount(){
        $this->items[time()] = [
            'mat' => NULL,
            'qty' => NULL,
        ];
        $this->allCs = $this->getAllConstructionSites();
        $this->mmInfo = MaterialMasterData::orderBy('name','ASC')->get();
    }

    public function addItem(){
        return $this->items[time()] = [
            'mat' => NULL,
            'qty' => NULL,
        ];
    }

    public function createOrder(){
        $validation = $this->validateData();
        if(!$validation){
            return;
        }
        dd($validation);
    }

    private function validateData(){
        $isValid = TRUE;
        $this->error = [];
        if(is_null($this->selectedCs) || $this->selectedCs == ""){
            $this->error['cs'] = TRUE;
        }
        foreach ($this->items as $key => $item) {
            if(($item['mat'] == NULL || $item['mat'] == "") && ($item['qty'] == NULL || $item['qty'] == "")){
                unset($this->items[$key]);
                continue;
            }
            if($item['mat'] == NULL || $item['mat'] == ""){
                $this->error[$key]['mat']=TRUE;
            }
            if($item['qty'] == NULL || $item['qty'] == ""){
                $this->error[$key]['qty']=TRUE;
            }
        }
        $isValid = count($this->error) ? FALSE : TRUE;
        return $isValid;
    }

    public function removeItem($itemKey){
        unset($this->items[$itemKey]);
        return;
    }

    private function getAllConstructionSites(){
        return ConstructionSiteModel::where('status', ConstructionSiteModel::CONSTRUCTION_STATUS_ACTIVE)->get();
    }
    
    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-internal-order-form');
    }
}
