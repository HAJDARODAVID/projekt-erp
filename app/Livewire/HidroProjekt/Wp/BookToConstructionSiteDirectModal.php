<?php

namespace App\Livewire\HidroProjekt\Wp;

use Livewire\Component;
use App\Models\MaterialMasterData;
use App\Models\ConstructionSiteModel;
use App\Services\HidroProjekt\STG\MovementTypes;
use App\Services\HidroProjekt\STG\MovementService;

class BookToConstructionSiteDirectModal extends Component
{
    public $activeModal = FALSE;
    public $mmInfo;
    public $itemCount = 1;
    public $bookingOrder = [];
    public $error = [];
    public $required = ['mat_id', 'qty'];
    public $constInfo;
    public $constId = NULL;

    public function mount(){
        $this->mmInfo = MaterialMasterData::orderBy('name','ASC')->get()->pluck('name', 'id');
        $this->constInfo = ConstructionSiteModel::where('status', 1)->get()->pluck('name', 'id');
        $this->bookingOrder[$this->itemCount] = [];
    }

    public function modalBtn($type){
        if($type==0){
            $this->itemCount                      = 1;
            $this->bookingOrder                   = [];
            $this->bookingOrder[$this->itemCount] = [];
        }
        return $this->activeModal = $type;
    }

    public function addItem(){
        $this->itemCount++;
        return $this->bookingOrder[$this->itemCount] = [];
    }

    public function removeItem($key){
        unset($this->bookingOrder[$key]);
        return;
    }

    public function bookToStorage(){
        $validation = $this->validation();
        if($validation){
            $service = new MovementService(
                $this->bookingOrder, 
                MovementTypes::BOOK_DIRECT_TO_CONSTRUCTION_SITE,
                constSite: $this->constId 
            );
            $store = $service->execute();
            if($store){
                $this->bookingOrder = [];
                return redirect()->route('hp_internalDeliveryNote');
            }
        }
        return;
    }

    private function validation(){
        $this->error = [];
        if($this->constId == NULL || $this->constId == 0 || $this->constId == ""){
            $this->error['constId'] = TRUE;
            return FALSE;
        }
        foreach ($this->bookingOrder as $key => $array) {
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
        return view('livewire.hidroprojekt.wp.book-to-construction-site-direct-modal');
    }
}
