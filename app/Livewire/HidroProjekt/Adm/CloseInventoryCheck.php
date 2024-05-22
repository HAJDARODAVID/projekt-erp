<?php

namespace App\Livewire\HidroProjekt\Adm;

use App\Models\InventoryCheckingModel;
use Livewire\Component;

class CloseInventoryCheck extends Component
{
    public $activeInventory;
    public $activeModal = 0;

    public function modalBtn($show){
        return $this->activeModal = $show;
    }

    public function canceledInventoryCheck(){
        $this->activeInventory->update([
            'status' => InventoryCheckingModel::INVENTORY_STATUS_CANCELED,
        ]);
        return redirect()->route('hp_mainInventory');
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.close-inventory-check');
    }
}
