<?php

namespace App\Livewire\HidroProjekt\Adm;

use App\Models\StorageStockItem;
use Livewire\Component;

class ActiveInventoryCheckingDiff extends Component
{
    public $activeInventory;

    public $stock;

    public function mount(){
        $this->stock = $this->setStock();
    }

    public function refreshData(){
        $this->stock = $this->setStock();
    }

    private function setStock(){
        return StorageStockItem::with('getMaterialInfo','getConstructionSiteInfo')
        ->where('qty', '>',0)
        ->orderBy('cons_id', 'asc')
        ->orderBy('str_loc', 'asc')
        ->get();
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.active-inventory-checking-diff');
    }
}
