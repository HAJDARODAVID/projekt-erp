<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class WarningIndicator extends Component
{
    public $show=false;

    public function mount(){
        $this->getIndicator();
    }

    public function getIndicator(){
        return $this->show = Auth::user()->inv_update;
    }

    public function render()
    {
        return view('livewire.warning-indicator');
    }
}
