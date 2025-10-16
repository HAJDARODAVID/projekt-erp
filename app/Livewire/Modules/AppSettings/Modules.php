<?php

namespace App\Livewire\Modules\AppSettings;

use Livewire\Component;
use Illuminate\Support\Facades\Route;

class Modules extends Component
{
    public function mount() {}
    public function render()
    {
        return view('livewire.modules.app-settings.modules');
    }
}
