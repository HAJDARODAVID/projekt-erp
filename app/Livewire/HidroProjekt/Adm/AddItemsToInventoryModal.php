<?php

namespace App\Livewire\HidroProjekt\Adm;

use App\Models\ConstructionSiteModel;
use Livewire\Component;
use App\Models\MaterialMasterData;
use Illuminate\Support\Facades\Auth;
use App\Services\HidroProjekt\ADM\MainInventoryService;

class AddItemsToInventoryModal extends Component
{
    public $modalStatus = false;
    public $inventoryItems = [];
    public $itemCount = 1;
    public $error = [];
    public $mmInfo;
    public $required = ['mat_id', 'qty'];
    public $location = 'main_storage';
    public $constSites;
    public $activeInventory;

    public function mount(){
        $this->mmInfo = MaterialMasterData::orderBy('name','ASC')->get()->pluck('name', 'id');
        $this->inventoryItems[$this->itemCount] = [];
        $this->constSites = ConstructionSiteModel::where('status', ConstructionSiteModel::CONSTRUCTION_STATUS_ACTIVE)->get();
    }

    public function addToInventory(){
        $validation = $this->validation();
        if($validation){
            $service = new MainInventoryService;
            $saveNewItems=$service->addItemsToInventoryList($this->inventoryItems,$this->location,Auth::user()->id,$this->activeInventory);
            if($saveNewItems){
                $this->itemCount                        = 1;
                $this->inventoryItems                   = [];
                $this->inventoryItems[$this->itemCount] = [];
                $this->location = 'main_storage';
                return $this->modalStatus = 0;
            }
        }
        return;
    }

    public function modalBtn($status){
        if($status==0){
            $this->itemCount                        = 1;
            $this->inventoryItems                   = [];
            $this->inventoryItems[$this->itemCount] = [];
            $this->location = 'main_storage';
        }
        return $this->modalStatus = $status;
    }

    public function addItem(){
        $this->itemCount++;
        return $this->inventoryItems[$this->itemCount] = [];
    }

    public function removeItem($key){
        unset($this->inventoryItems[$key]);
        return;
    }

    private function validation(){
        $this->error = [];
        foreach ($this->inventoryItems as $key => $array) {
            if(empty($array)){
                $this->removeItem($key);
                continue;
            };  
            if((isset($array['mat_id']) && ($array['mat_id'] == 0 || $array['mat_id'] =='')) && (isset($array['qty']) && ($array['qty'] == 0 || $array['qty'] ==''))){
                $this->removeItem($key);
                continue;
            }
            foreach ($this->required as $colName) {
                if(!isset($array[$colName]) || $array[$colName] == '0' || $array[$colName] == ""){
                    $this->error[$key][$colName] = TRUE;
                }
            }        
        }
        //Return true if valid
        return empty($this->error);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.add-items-to-inventory-modal');
    }
}
