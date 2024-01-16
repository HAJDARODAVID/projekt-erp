<?php

namespace App\Livewire\HidroProjekt\Bde;

use Livewire\Component;

class BdeGroupLeaderHours extends Component
{   
    public $record;
    public $workHours = NULL;

    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-group-leader-hours');
    }
}
