<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CooperatorWorkersModel extends Model
{
    use HasFactory;

    protected $table = 'cooperator_workers';
    protected $fillable = [
        'cooperator_id',
        'firstName',
        'lastName',
        'status',
    ];
}
