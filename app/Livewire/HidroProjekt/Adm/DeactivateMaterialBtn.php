<?php

namespace App\Livewire\HidroProjekt\Adm;

use Livewire\Component;

class DeactivateMaterialBtn extends Component
{
    public $mmInfo;

    public function deactivate(){
        $this->mmInfo->update([
            'active' => FALSE,
        ]);
        return redirect()->route('hp_masterMaterial');
    }
    public function render()
    {
        return view('livewire.hidroprojekt.adm.deactivate-material-btn');
    }
}
