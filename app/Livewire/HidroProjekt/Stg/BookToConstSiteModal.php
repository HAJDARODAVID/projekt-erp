<?php

namespace App\Livewire\HidroProjekt\Stg;

use App\Models\ConstructionSiteModel;
use App\Models\StorageStockItem;
use Livewire\Component;
use App\Services\HidroProjekt\STG\MovementTypes;
use App\Services\HidroProjekt\STG\MovementService;
use App\Services\HidroProjekt\STG\StorageLocation;

class BookToConstSiteModal extends Component
{
    public $activeModal = FALSE;
    public $stockInfo;
    public $constInfo;
    public $itemCount = 1;
    public $constId = NULL;
    public $availableQty = [];
    public $bookingOrder = [];
    public $error = [];
    public $required = ['mat_id', 'qty'];

    public $test = NULL;

    public function mount(){
        $this->stockInfo = StorageStockItem::where('str_loc', StorageLocation::MAIN_STORAGE)->where('qty', '>', 0)->with('getMaterialInfo')->get();
        $this->constInfo = ConstructionSiteModel::where('status', 1)->get()->pluck('name', 'id');
        $this->bookingOrder[$this->itemCount] = [];
    }

    public function modalBtn($type){
        if($type==0){
            $this->itemCount                      = 1;
            $this->bookingOrder                   = [];
            $this->bookingOrder[$this->itemCount] = [];
            $this->error                          = [];
            $this->availableQty                   = [];
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
                MovementTypes::BOOK_FROM_STORAGE_TO_CONST_SITE,
                StorageLocation::CONSTRUCTION_SITE,
                StorageLocation::MAIN_STORAGE,
                $this->constId,
            );
            $store = $service->execute();
            if($store){
                $this->bookingOrder = [];
                return redirect()->route('hp_internalDeliveryNote');
            }
        }
        return;
    }

    public function updatedBookingOrder($key, $value){
        list($arrayKey, $columnName) = explode('.', $value);
        if($this->searchInArray($key) && $columnName == 'mat_id'){
            unset($this->bookingOrder[$arrayKey]['mat_id']);
            return;
        }
        $this->stockInfo->fresh();
        if($columnName == 'mat_id'){
            $this->availableQty[$arrayKey] = $this->stockInfo->where('mat_id', $key)->first()->qty;
        }

        if($columnName == 'qty'){
            if($key > $this->availableQty[$arrayKey]){
                $this->bookingOrder[$arrayKey]['qty'] = $this->availableQty[$arrayKey];
            }
        }
        
    }

    private function validation(){
        $this->error = [];
        if($this->constId == NULL && $this->constId == 0){
            $this->error['constId'] = TRUE;
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

    private function searchInArray($what){
        $i=0;
        foreach ($this->bookingOrder as $item) {
            if(array_search($what, $item)){
                $i++;
            }
        }
        return $i>1 ? TRUE : FALSE;
    }
    
    public function render()
    {
        return view('livewire.hidroprojekt.stg.book-to-const-site-modal');
    }
}
