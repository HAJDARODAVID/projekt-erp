<?php

namespace App\Livewire\HidroProjekt\Adm;

use App\Models\InventoryCheckingItem;
use App\Models\StorageStockItem;
use Livewire\Component;

use function PHPUnit\Framework\isNull;

class ActiveInventoryCheckingDiff extends Component
{
    public $activeInventory;

    public $stock;
    public $invStock;
    public $additionalItems;

    public function mount(){
        $this->stock = $this->setCurrentStock();
        $this->invStock = $this->setInvStock();
        $this->additionalItems = $this->findAdditionalItems();
    }

    public function refreshData(){
        $this->stock = $this->setCurrentStock();
        $this->invStock = $this->setInvStock();
        $this->additionalItems = $this->findAdditionalItems();
    }

    private function setCurrentStock(){
        return StorageStockItem::with('getMaterialInfo','getConstructionSiteInfo')
        ->where('qty', '>',0)
        ->orderBy('cons_id', 'asc')
        ->orderBy('str_loc', 'asc')
        ->get();
    }

    private function setInvStock(){
        return InventoryCheckingItem::where('inv_id', $this->activeInventory->id)->get();
    }

    private function findAdditionalItems(){
        $invItems = InventoryCheckingItem::where('inv_id', $this->activeInventory->id)
            ->with('getMaterialInfo', 'getConstructionSiteInfo')->get();
        $stock = $this->setCurrentStock();

        $array=[];
        foreach ($invItems as $item) {
            $check = $stock->where('mat_id',$item->mat_id)
                ->where('str_loc', $item->str_loc)
                ->where('cons_id', $item->cons_id)->first();
            if(is_null($check)){
                $array[]=[
                    'mat_id' => $item->mat_id,
                    'mat_name' => $item->getMaterialInfo->name,
                    'str_loc' => $item->str_loc,
                    'cons_site' => is_null($item->getConstructionSiteInfo) ? NULL : $item->getConstructionSiteInfo->name,
                    'qty' => $item->qty,
                ];
            }
        }
        return $this->additionalItems = $array;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.active-inventory-checking-diff');
    }
}
