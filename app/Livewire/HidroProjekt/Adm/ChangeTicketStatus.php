<?php

namespace App\Livewire\HidroProjekt\Adm;

use App\Models\TicketModel;
use App\Services\HidroProjekt\ADM\TicketService;
use Livewire\Component;

class ChangeTicketStatus extends Component
{
    public $status;
    public $allStatuses;
    public $ticket;

    public function mount(){
        $this->allStatuses = TicketModel::TICKET_STATUS;
    }

    public function updatedStatus($key){
        $service = new TicketService;
        $service->updateTicketInfo($this->ticket, ['status' => $key]);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.change-ticket-status');
    }
}
