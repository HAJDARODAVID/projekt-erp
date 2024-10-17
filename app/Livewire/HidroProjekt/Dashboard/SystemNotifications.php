<?php

namespace App\Livewire\HidroProjekt\Dashboard;

use App\Services\HidroProjekt\Domain\Notifications\NotificationsService;
use Livewire\Component;
use Livewire\Attributes\On;

class SystemNotifications extends Component
{
    /**
     * Obavijesti sustava
     */
    public $items;
    public $itemCount;

    public function mount(NotificationsService $service){
        $this->getData($service);
    }

    #[On('refresh-system-notifications')]
    public function getData(NotificationsService $service){
        $service = $service->getAllNotifications();
        $this->items = $service->toArray();
        $this->itemCount = $service->count();
    }

    public function render()
    {
        return view('livewire.hidroprojekt.dashboard.system-notifications');
    }
}
