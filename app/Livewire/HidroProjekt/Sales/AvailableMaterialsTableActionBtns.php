<?php

namespace App\Livewire\HidroProjekt\Sales;

use Livewire\Component;
use Livewire\Attributes\On;

class AvailableMaterialsTableActionBtns extends Component
{
    public $row;
    public $show;

    public function mount(){
        $this->dispatch('check-if-key-is-in-receipt', $this->row->mat_id); 
    }

    #[On('is-mat-in-receipt')]
    public function setShow($data){
        if($this->row->mat_id == $data['mat_id']){
            return $this->show = !($data['is_set']);
        }
    } 

    public function addToRegistersItems(){
        $this->show = FALSE;
        return $this->dispatch('add-new-item-to-register', $this->row);
    }
    public function render()
    {
        return view('livewire.hidroProjekt.sales.available-materials-table-action-btns');
    }
}
