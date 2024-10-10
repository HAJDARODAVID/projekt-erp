<?php

namespace App\Livewire\HidroProjekt\Sales;

use Livewire\Component;

class RegisterComponent extends Component
{
    public $addMaterialModalShow = FALSE;

    public function toggleAddMaterialModal(){
        return $this->addMaterialModalShow= $this->addMaterialModalShow == FALSE ? TRUE : FALSE;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.sales.register-component');
    }
}
