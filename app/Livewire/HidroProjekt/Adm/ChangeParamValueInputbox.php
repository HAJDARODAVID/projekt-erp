<?php

namespace App\Livewire\HidroProjekt\Adm;

use Livewire\Component;

class ChangeParamValueInputbox extends Component
{
    public $row;
    public $value;

    public function mount(){
        $this->value = $this->row->value;
    }

    public function updatedValue($key){
        if($key == ""){
            $key=NULL;
        }
        $this->row->update([
            'value' => $key,
        ]);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.change-param-value-input-box');
    }
}
