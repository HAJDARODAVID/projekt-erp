<?php

namespace App\Livewire\HidroProjekt\Dashboard\Components;

use App\Models\Notifications;
use Livewire\Component;

class SystemNotificationsAlertCard extends Component
{
    const ALERT_TYPE = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
    public $aType = 'light';
    public $title = "";
    public $message = "";
    public $item;

    public function mount(){
        $this->title = $this->setTitle();
        $this->message = $this->seMessage();
    }

    private function setTitle(){
        return $this->item != NULL ? Notifications::TYPES_INFO[$this->item->type]['name'] : NULL;
    }
    private function seMessage(){
        return $this->item != NULL ? $this->item->message : NULL;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.dashboard.components.system-notifications-alert-card');
    }
}
