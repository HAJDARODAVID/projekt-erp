<?php

namespace App\Livewire\HidroProjekt\Bde;

use Livewire\Component;
use App\Models\MaterialMasterData;
use Illuminate\Support\Facades\Auth;
use App\Models\ConstructionSiteModel;
use App\Models\InventoryCheckingItem;
use App\Services\HidroProjekt\STG\StorageLocation;

class BdeMaterialInventoryList extends Component
{
    public $activeInv;
    public $constructionSites;
    public $selectedConstructionSite = NULL;
    public $invItems =[];
    public $invItemsCount = 1;
    public $mmInfo;
    public $itemsList;
    public $inpBoxSaveState = [];

    public function mount(){
        $this->constructionSites = $this->getAllConstructionSites();
        $this->mmInfo = MaterialMasterData::orderBy('name','ASC')->get()->pluck('name', 'id');
    }

    public function updatedInvItems($key, $value){
        list($itemNr, $column) = explode('.',$value);
        $this->inpBoxSaveState=[];
        if($this->invItems[$itemNr]['table_id']){
            $oneItemFromInvList = $this->itemsList->where('id', $this->invItems[$itemNr]['table_id'])->first();
            if($column=='qty'){
                if($key <= 0 || $key==""){
                    $this->invItems[$itemNr]['qty'] = $oneItemFromInvList->qty;
                    return; //$this->inpBoxSaveState[$itemNr][$column] = 'is-invalid';
                }
                if(is_numeric($key)){
                    $oneItemFromInvList->update([
                        'qty' => $key,
                    ]);
                    return $this->inpBoxSaveState[$itemNr][$column] = 'is-valid';
                }
            }
            if($column=='mat_id'){
                if($key == 0 || $key==""){
                    $this->invItems[$itemNr]['mat_id'] = $oneItemFromInvList->mat_id;
                    return;
                }else{
                    $oneItemFromInvList->update([
                        'mat_id' => $key,
                    ]);
                    return $this->inpBoxSaveState[$itemNr][$column] = 'is-valid';
                }
            }
        }
        if($column=='qty'){
            if($key <= 0 || $key==""){
                $this->invItems[$itemNr]['qty'] = NULL;
                return $this->inpBoxSaveState[$itemNr][$column] = 'is-invalid';
            }
        }
    }

    public function saveItemsToInventoryList(){
        foreach ($this->invItems as $item) {
            if(!$item['table_id']){
                if((isset($item['mat_id']) && $item['mat_id'] != 0) && (isset($item['qty']) && $item['mat_id'] > 0 && $item['mat_id'] != NULL)){
                    InventoryCheckingItem::create([
                        'inv_id' => $this->activeInv->id, 
                        'mat_id' => $item['mat_id'], 
                        'qty' => $item['qty'], 
                        'user_id' => Auth::user()->id, 
                        'str_loc' => StorageLocation::CONSTRUCTION_SITE, 
                        'cons_id' => $this->selectedConstructionSite,
                    ]);
                }
            }
        }
        $this->setInvItems();
        $this->invItemsCount--;
    }

    public function updatedSelectedConstructionSite(){
        $this->itemsList = InventoryCheckingItem::where('inv_id', $this->activeInv->id)
            ->where('cons_id', $this->selectedConstructionSite)
            ->where('user_id', Auth::user()->id)->get();
        $this->setInvItems();
        $this->invItemsCount--;
        //dd($this->invItems);
    }

    public function addItem(){
        $this->invItemsCount++;
        return $this->invItems[$this->invItemsCount] = ['table_id' => NULL];
    }

    private function setInvItems(){
        $this->resetInvItems();
        foreach($this->itemsList as $item){
            $this->invItems[$this->invItemsCount]=[
                'table_id' => $item->id,
                'mat_id' => $item->mat_id,
                'qty' => $item->qty
            ];
            $this->invItemsCount++;
        }
    }

    private function resetInvItems(){
        $this->invItemsCount = 1;
        $this->invItems=[];
        return $this->invItems[$this->invItemsCount]=[
            'table_id' => NULL,
            'mat_id' => NULL,
            'qty' => NULL
        ];
    }

    private function getAllConstructionSites(){
        return ConstructionSiteModel::where('status', ConstructionSiteModel::CONSTRUCTION_STATUS_ACTIVE)->get();
    }
    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-material-inventory-list');
    }
}
