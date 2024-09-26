<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MyProfileComponent extends Component
{
    public $userName;

    public function mount(){
        $this->userName = User::where('id', Auth::user()->id)->with('getWorker')->first()->getWorker->fullName; 
    }

    public function render()
    {
        return view('livewire.my-profile-component');
    }
}
