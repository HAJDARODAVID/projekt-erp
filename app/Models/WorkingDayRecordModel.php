<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingDayRecordModel extends Model
{
    use HasFactory;

    protected $table ="working_day_record";

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

}
