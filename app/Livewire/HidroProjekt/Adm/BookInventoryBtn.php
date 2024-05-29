<?php

namespace App\Livewire\HidroProjekt\Adm;

use Livewire\Component;

class BookInventoryBtn extends Component
{
    public $activeInventory;
    
    public function render()
    {
        return view('livewire.hidroprojekt.adm.book-inventory-btn');
    }
}
