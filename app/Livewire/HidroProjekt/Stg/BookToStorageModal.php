<?php

namespace App\Livewire\HidroProjekt\Stg;

use App\Models\MaterialMasterData;
use Livewire\Component;

class BookToStorageModal extends Component
{
    public $activeModal = FALSE;
    public $mmInfo;
    public $itemCount = 1;
    public $bookingOrder = [];

    public function mount(){
        $this->mmInfo = MaterialMasterData::orderBy('name','ASC')->get()->pluck('name', 'id');
        $this->bookingOrder[$this->itemCount] = [];
    }

    public function modalBtn($type){
        return $this->activeModal = $type;
    }

    public function addItem(){
        $this->itemCount++;
        return $this->bookingOrder[$this->itemCount] = [];
    }

    public function removeItem($key){
        unset($this->bookingOrder[$key]);
        return;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.stg.book-to-storage-modal');
    }
}
