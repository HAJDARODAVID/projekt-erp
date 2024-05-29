<?php

namespace App\Livewire\HidroProjekt\Adm;

use Livewire\Component;

class BookInventoryBtn extends Component
{
    public $activeInventory;

    public function bookInventory(){
        dd('booking');
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.book-inventory-btn');
    }
}
