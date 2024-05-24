<?php

namespace App\Livewire\HidroProjekt\Adm;

use Livewire\Component;
use Livewire\Attributes\On;

class InventoryCheckingListInputbox extends Component
{
    public $row;

    public $qtyValue;

    #[On('refresh-the-component')]
    public function mount(){
        $this->qtyValue = $this->row->qty;
    }

    public function updatedQtyValue($key){
        if(!is_numeric($key)){
            return $this->dispatch('refresh-the-component');
        }
        $this->row->update([
            'qty' => $key,
        ]);
        return $this->dispatch('refreshInventoryCheckingListTable');
    }

    public function deleteFromList(){
        $this->row->delete();
        return $this->dispatch('refreshInventoryCheckingListTable');
        
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.inventory-checking-list-inputbox');
    }
}
