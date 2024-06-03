<?php

namespace App\Livewire\HidroProjekt\Adm;

use App\Services\HidroProjekt\ADM\MainInventoryService;
use Livewire\Component;

class BookInventoryBtn extends Component
{
    public $successModalStatus = false;
    public $activeInventory;

    public function bookInventory(){
        $service = new MainInventoryService;
        $service->bookMainInventory($this->activeInventory);
        return $this->successModalStatus = TRUE;
        dd('booking');
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.book-inventory-btn');
    }
}
