<?php

namespace App\Livewire\HidroProjekt\Adm;

use App\Models\User;
use Livewire\Component;
use App\Models\WorkerModel;
use Illuminate\Support\Facades\Hash;

class EditUserModal extends Component
{
    public $data;
    public $row;
    public $resetStatus = NULL;
    public $modalStatus = NULL;
    public $workerInfo;

    public function mount(){
        $this-> data = $this->row->toArray();
        $this->workerInfo = WorkerModel::find($this->row->worker_id)->toArray();
    }

    public function activateUser(){
        $this->row->update([
            'active' => TRUE,
        ]);
        return $this->dispatch('refreshUserTable');
    }

    public function resetPassword(){
        $this->row->update([
            'password' => Hash::make(User::DEFAULT_PASSWORD),
        ]);
        $this->dispatch('show-alert-modal', [
            'title' => 'USPJEŠNO!',
            'message' => "Uspješno resetiran loznika. <br /> Nova lozinka: 123456",
            'type' => 'success',
        ]);
    }

    public function modalBtn($status){
        return $this->modalStatus = $status;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.edit-user-modal');
    }
}
