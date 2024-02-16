<?php

namespace App\Livewire\HidroProjekt\Adm;

use App\Models\AppParametersModel;
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
            return;
        }
        AppParametersModel::create([
            'param_name' => $this->row->param_name,
            'param_name_srt' => $this->row->param_name_srt,
            'value' => $key,
            'active' => 1,
        ]);
        $this->row->update([
            'active' => FALSE,
        ]);
        //$this->dispatch('refreshAppParamsTable');
        return redirect()->route('hp_appParams');
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.change-param-value-input-box');
    }
}
