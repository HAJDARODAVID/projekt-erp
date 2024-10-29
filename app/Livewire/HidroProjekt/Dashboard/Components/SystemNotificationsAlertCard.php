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
    public $moreOption = NULL;

    public function mount(){
        $this->title = $this->setTitle();
        $this->message = $this->seMessage();
        $this->aType = $this->setAType();
        $this->moreOption = $this->setMoreOption();
    }

    private function setTitle(){
        return $this->item != NULL ? Notifications::TYPES_INFO[$this->item->type]['name'] : NULL;
    }

    private function setAType(){
        return $this->item != NULL ? Notifications::TYPES_INFO[$this->item->type]['a_type'] : NULL;
    }

    private function seMessage(){
        return $this->item != NULL ? $this->item->message : NULL;
    }

    private function setMoreOption(){
        return $this->item != NULL ? Notifications::TYPES_INFO[$this->item->type]['moreOption'] : NULL;
    }

    public function markAsSeenBtn(){
        (new NotificationsService())->markAsSeen($this->item->id);
        return $this->dispatch('refresh-system-notifications');
    }

    public function openMore(){
        return $this->dispatch('open-system-notification-more-modal', $this->item);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.dashboard.components.system-notifications-alert-card');
    }
}
