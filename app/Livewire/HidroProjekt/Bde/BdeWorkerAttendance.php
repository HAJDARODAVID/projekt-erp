<?php

namespace App\Livewire\HidroProjekt\Bde;

use Livewire\Component;

class BdeWorkerAttendance extends Component
{   
    public $record;

    
    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-worker-attendance');
    }
}
