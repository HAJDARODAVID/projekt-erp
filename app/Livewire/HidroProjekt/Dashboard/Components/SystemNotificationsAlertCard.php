<?php

namespace App\Livewire\HidroProjekt\Dashboard\Components;

use App\Models\Notifications;
use App\Services\HidroProjekt\Domain\Notifications\NotificationsService;
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
        $this->aType = $this->setAType();
    }

    private function setTitle(){
        return $this->item != NULL ? Notifications::TYPES_INFO[$this->item->type]['name'] : NULL;
    }

    private function setAType(){
        if(isset(Notifications::TYPES_INFO[$this->item->type]['a_type'])){
            return $this->item != NULL ? Notifications::TYPES_INFO[$this->item->type]['a_type'] : NULL;   
        }
        return 'light';
    }

    private function seMessage(){
        return $this->item != NULL ? $this->item->message : NULL;
    }

    public function markAsSeenBtn(){
        (new NotificationsService())->markAsSeen($this->item->id);
        return $this->dispatch('refresh-system-notifications');
    }

    public function render()
    {
        return view('livewire.hidroprojekt.dashboard.components.system-notifications-alert-card');
    }
}
