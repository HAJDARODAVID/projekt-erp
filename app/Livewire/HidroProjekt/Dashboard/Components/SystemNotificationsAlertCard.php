<?php

namespace App\Livewire\HidroProjekt\Dashboard\Components;

use Livewire\Component;

class SystemNotificationsAlertCard extends Component
{
    const ALERT_TYPE = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
    public $aType = 'light';
    public function render()
    {
        return view('livewire.hidroprojekt.dashboard.components.system-notifications-alert-card');
    }
}
