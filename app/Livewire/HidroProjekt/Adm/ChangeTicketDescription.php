<?php

namespace App\Livewire\HidroProjekt\Adm;

use Livewire\Component;
use App\Services\HidroProjekt\ADM\TicketService;

class ChangeTicketDescription extends Component
{
    public $jobDescription;
    public $ticket;

    public function updatedJobDescription(){
        $service = new TicketService;
        $service->updateTicketInfo($this->ticket, ['job_description' => $this->jobDescription]);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.change-ticket-description');
    }
}
