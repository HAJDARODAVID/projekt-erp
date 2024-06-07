<?php

namespace App\Livewire\HidroProjekt\Adm;

use Livewire\Component;

class EditUserModal extends Component
{

    public $row;

    public function render()
    {
        return view('livewire.hidroprojekt.adm.edit-user-modal');
    }
}
