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

}
