<?php

namespace App\Models;

use App\Models\WorkerAddress;
use App\Models\WorkerContact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkerModel extends Model
{
    use HasFactory;

    const DEFAULT_COMPANY = 'HIDRO-PROJEKT';

    const WORKER_STATUS_EMPLOYED = 1;
    const WORKER_STATUS_EX_EMPLOYEE = -1;


    protected $table = 'workers';

    protected $fillable = [
        'firstName',
        'lastName',
        'company',
        'OIB',
        'working_place',
        'doe',
        'ced',
        'comment',
        'print_label',
        'status',
        'is_worker',
    ];

    public function getWorkerAddress():HasOne{
        return $this->hasOne(WorkerAddress::class, 'worker_id','id');
    }

    public function getWorkerContact():HasOne{
        return $this->hasOne(WorkerContact::class, 'worker_id','id');
    }
}
