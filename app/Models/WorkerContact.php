<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerContact extends Model
{
    use HasFactory;

    protected $table = 'worker_contact';

    public $timestamps = false;

    protected $fillable = [
        'worker_id',
        'mob',
        'email',
    ];
}
