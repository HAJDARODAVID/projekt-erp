<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Models\User;
use App\Services\HidroProjekt\ADM\UserService;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateNewUserFromWorkerBtn extends Component
{
    public $worker;
    public $hasUser;
    public $email;
    public $disableCreateBtn = TRUE;
    public $activeModal = NULL;


    public function mount(){
        $this->hasUser = UserService::doesWorkerHaveUser($this->worker->id);
    }

    public function updatedEmail(){
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        
            $this->disableCreateBtn = FALSE;
        }
    }

    public function setActiveModal(){
        $this->activeModal = TRUE;
    }

    public function unSetActiveModal(){
        $this->activeModal = NULL;
    }

    public function createUser(){
        $service = new UserService;
        $service->createNewUser([
            'name' => $this->worker->fistName,
            'email'=> $this->email,
            'password' =>Hash::make(User::DEFAULT_PASSWORD),
            'type' =>User::USER_TYPE_GROUP_LEADER,
            'worker_id' => $this->worker->id,
        ]);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.create-new-user-from-worker-btn');
    }
}
