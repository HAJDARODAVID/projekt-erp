<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerAddress extends Model
{
    use HasFactory;

    protected $table = 'worker_address';

    public $timestamps = false;

    protected $fillable = [
        'worker_id',
        'street',
        'town',
        'zip',
        'county',
    ];
}
