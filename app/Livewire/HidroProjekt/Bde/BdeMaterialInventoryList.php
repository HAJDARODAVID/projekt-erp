<?php

namespace App\Livewire\HidroProjekt\Bde;

use Livewire\Component;
use App\Models\MaterialMasterData;
use Illuminate\Support\Facades\Auth;
use App\Models\ConstructionSiteModel;
use App\Models\InventoryCheckingItem;

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
            
        }
    }

    public function updatedSelectedConstructionSite(){
        $this->itemsList = InventoryCheckingItem::where('inv_id', $this->activeInv->id)
            ->where('cons_id', $this->selectedConstructionSite)
            ->where('user_id', Auth::user()->id)->get();
        $this->resetInvItems();
        foreach($this->itemsList as $item){
            $this->invItems[$this->invItemsCount]=[
                'table_id' => $item->id,
                'mat_id' => $item->mat_id,
                'qty' => $item->qty
            ];
            $this->invItemsCount++;
        }
        $this->invItemsCount--;
        //dd($this->invItems);
    }

    public function addItem(){
        $this->invItemsCount++;
        return $this->invItems[$this->invItemsCount] = ['table_id' => NULL];
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
