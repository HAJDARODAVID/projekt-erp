<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketModel extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    protected $fillable = [
        'ticketName',
        'job_description',
        'priority',
        'createdBy',
    ];
}
