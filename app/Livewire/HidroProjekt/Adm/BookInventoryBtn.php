<?php

namespace App\Livewire\HidroProjekt\Adm;

use Livewire\Component;

class BookInventoryBtn extends Component
{
    public $successModalStatus = false;
    public $activeInventory;

    public function bookInventory(){
        return $this->successModalStatus = TRUE;
        dd('booking');
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.book-inventory-btn');
    }
}
