<?php

namespace App\Livewire\HidroProjekt\Adm;

use Livewire\Component;

class DeleteUserModal extends Component
{
    public $row;

    public function deleteUser(){
        $this->row->update([
            'active' => false
        ]);
        return $this->dispatch('refreshUserTable');
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.delete-user-modal');
    }
}
