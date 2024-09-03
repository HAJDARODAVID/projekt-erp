<?php

namespace App\Livewire\HidroProjekt\Adm;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Services\HidroProjekt\ADM\MainInventoryService;
use Illuminate\Support\Facades\Request;

class InventoryCheckingInputbox extends Component
{

    public $item;
    public $invStock;
    public $activeInventory;

    public $displayInput = FALSE;

    public $qty;

    public function mount(){
        $this->setQty();
    }

    public function openInputBox(){
        if($this->item->str_loc == 10000){
            return $this->displayInput = TRUE;
        }
        return;
    }

    public function updatedQty($key){
        if($key == 0 || $key == ""){
            $this->setQty();
            return $this->displayInput = FALSE;
        }
        $invListItem = $this->invStock
            ->where('mat_id',$this->item->mat_id)
            ->where('str_loc', $this->item->str_loc)
            ->where('cons_id', $this->item->cons_id)->first();
        if(!is_null($invListItem)){
            $invListItem->update([
                'qty' => $key,
            ]);
        }else{
            $inventoryItems=[];
            $inventoryItems[] = [
                'mat_id' => $this->item->mat_id,
                'qty' => $key,
            ];
            $service = new MainInventoryService;
            $saveNewItems=$service->addItemsToInventoryList(
                $inventoryItems,
                'main_storage',
                Auth::user()->id,
                $this->activeInventory);

        }
        return $this->displayInput = FALSE;
    }

    private function setQty(){
        return $this->qty = $this->invStock
                ->where('mat_id',$this->item->mat_id)
                ->where('str_loc', $this->item->str_loc)
                ->where('cons_id', $this->item->cons_id)
                ->sum('qty');
    }
    
    public function render()
    {
        return view('livewire.hidroprojekt.adm.inventory-checking-inputbox');
    }
}
