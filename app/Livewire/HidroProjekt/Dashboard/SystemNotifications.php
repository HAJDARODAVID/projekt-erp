<?php

namespace App\Livewire\HidroProjekt\Dashboard;

use Livewire\Component;

class SystemNotifications extends Component
{
    /**
     * Obavijesti sustava
     */

    public $itemCount = 1;

    public function render()
    {
        return view('livewire.hidroprojekt.dashboard.system-notifications');
    }
}
