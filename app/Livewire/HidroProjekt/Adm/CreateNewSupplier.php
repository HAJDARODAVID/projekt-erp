<?php

namespace App\Livewire\HidroProjekt\Adm;

use Livewire\Component;

class CreateNewSupplier extends Component
{
    public $supplier;
    public $error;

    public function saveBtn(){
        unset($this->error['supplier']);
        if($this->supplier == ''){
            return $this->error['supplier'] = TRUE;
        }
        return $this->supplier = 'test';
    }
    public function render()
    {
        return view('livewire.hidroprojekt.adm.create-new-supplier');
    }
}
