<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceModel extends Model
{
    use HasFactory;

    protected $table = 'attendance';

    protected $fillable = [
        'worker_id',
        'working_day_record_id',
        'type',
        'work_hours',
        'absence_reason',
        'date',
    ];
}
