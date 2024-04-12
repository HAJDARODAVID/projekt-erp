<?php

namespace App\Livewire\HidroProjekt\Wp;

use stdClass;
use Livewire\Component;
use App\Models\StorageStockItem;
use App\Models\ConstructionSiteModel;
use App\Services\HidroProjekt\STG\MovementTypes;
use App\Services\HidroProjekt\STG\MovementService;
use App\Services\HidroProjekt\STG\StorageLocation;

class BookFromConstSiteModal extends Component
{
    public $activeModal = FALSE;
    public $constInfo;
    public $availableQty = [];
    public $bookingOrder = [];
    public $itemCount    = 1;
    public $constId      = NULL;
    public $error = [];
    public $stockInfo;
    public $required = ['mat_id', 'qty'];

    public function mount(){
        $this->constInfo = $this->getConstructionsSitesWithMaterials();
        $this->bookingOrder[$this->itemCount] = [];
        $this->stockInfo = new stdClass();
    }

    public function bookToStorage(){
        $validation = $this->validation();
        if($validation){
            $service = new MovementService(
                $this->bookingOrder, 
                MovementTypes::BOOK_FROM_CONST_SITE_TO_STORAGE,
                StorageLocation::MAIN_STORAGE,
                StorageLocation::CONSTRUCTION_SITE,
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

    public function updatedConstId(){
        $this->resetOrder();
        return $this->stockInfo = StorageStockItem::where('str_loc', StorageLocation::CONSTRUCTION_SITE)
            ->where('cons_id', $this->constId)
            ->where('qty', '>', 0)
            ->with('getMaterialInfo')
            ->get();
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

    public function removeItem($key){
        unset($this->bookingOrder[$key]);
        return;
    }

    public function addItem(){
        $this->itemCount++;
        return $this->bookingOrder[$this->itemCount] = [];
    }

    public function updatedBookingOrder($key, $value){
        list($arrayKey, $columnName) = explode('.', $value);
        if($this->searchInArray($key) && $columnName == 'mat_id'){
            unset($this->bookingOrder[$arrayKey]['mat_id']);
            unset($this->bookingOrder[$arrayKey]['qty']);
            unset($this->availableQty[$arrayKey]);
            return;
        }
        $this->stockInfo->fresh();
        if($columnName == 'mat_id'){
            if($key=='0' || is_null($key)){
                $this->availableQty[$arrayKey] = NULL;
                $this->bookingOrder[$arrayKey]['qty'] = NULL;
            }else{
                $this->availableQty[$arrayKey] = $this->stockInfo->where('mat_id', $key)->first()->qty;
            }  
        }

        if($columnName == 'qty'){
            if($key > $this->availableQty[$arrayKey]){
                $this->bookingOrder[$arrayKey]['qty'] = $this->availableQty[$arrayKey];
            }
        }   
    }

    public function addAllStock(){
        //reset current order
        $this->resetOrder();
        foreach ($this->stockInfo as $stock) {
            $this->bookingOrder[$this->itemCount]=[
                'mat_id' => $stock->mat_id,
                'qty' => $stock->qty,
            ];
            $this->availableQty[$this->itemCount] = $stock->qty;
            $this->itemCount++;
        }
    }

    private function getConstructionsSitesWithMaterials(){
        $constSiteStock = StorageStockItem::where('str_loc', StorageLocation::CONSTRUCTION_SITE)
            ->where('cons_id', '!=', NULL)
            ->where('qty', '>', 0)
            ->pluck('cons_id')->toArray();
        $constSites = ConstructionSiteModel::whereIn('id',$constSiteStock)->pluck('name','id')->toArray();
        return $constSites;
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

    private function resetOrder(){
        $this->itemCount    = 1;
        $this->bookingOrder = [];
        $this->availableQty = [];
        $this->bookingOrder[$this->itemCount] = [];
        return;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.wp.book-from-const-site-modal');
    }
}
