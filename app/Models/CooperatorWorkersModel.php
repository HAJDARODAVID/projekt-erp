<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CooperatorWorkersModel extends Model
{
    use HasFactory;

    const COOPERATORS_WORKER_STATUS_ACTIVE = 1;
    const COOPERATORS_WORKER_STATUS_INACTIVE = 0;

    const COOPERATORS_STATUS = array(
        self::COOPERATORS_WORKER_STATUS_ACTIVE => 'Aktivni',
        self::COOPERATORS_WORKER_STATUS_INACTIVE => 'Ne aktivni',
    );

    protected $table = 'cooperator_workers';
    protected $fillable = [
        'cooperator_id',
        'firstName',
        'lastName',
        'status',
    ];
}
