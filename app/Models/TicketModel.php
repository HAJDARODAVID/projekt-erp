<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketModel extends Model
{
    use HasFactory;

    const TICKET_STATUS_CREATED = 1;
    const TICKET_STATUS_CANCELED = -1;
    const TICKET_STATUS_WIP = 5;
    const TICKET_STATUS_PRODUCTION = 10;

    const TICKET_STATUS = [
        self::TICKET_STATUS_CREATED => 'Predan zahtjev',
        self::TICKET_STATUS_CANCELED => 'Storno',
        self::TICKET_STATUS_WIP => 'U izradi',
        self::TICKET_STATUS_PRODUCTION => 'Implementirano',
    ];

    protected $table = 'tickets';
    protected $fillable = [
        'ticketName',
        'job_description',
        'priority',
        'createdBy',
        'status',
    ];
}
