<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerModel extends Model
{
    use HasFactory;

    const DEFAULT_COMPANY = 'HIDRO-PROJEKT';

    protected $table = 'workers';

    protected $fillable = [
        'firstName',
        'lastName',
        'company',
        'employed',
        'OIB',
        'working_place',
        'doe',
        'ced',
        'comment',
        'print_label',
    ];
}
