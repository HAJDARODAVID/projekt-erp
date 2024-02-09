<?php

namespace App\Services\HidroProjekt\ADM;

use App\Models\TicketModel;

/**
 * Class TicketService.
 */
class TicketService
{

    public function createNewTicket($data){
        $newTicket= TicketModel::create($data);
        return $newTicket;
    }

    public function getTicketInfo($ticket){
        $ticket= TicketModel::find($ticket);
        return $ticket;
    }

    public function updateTicketInfo($ticket, $data){
        $ticket= TicketModel::find($ticket);
        $ticket->update($data);
        return;
    }

}
