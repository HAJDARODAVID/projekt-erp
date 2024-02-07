<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceCoOpModel extends Model
{
    use HasFactory;

    protected $table='attendance_co_op';

    protected $fillable = [
        'worker_id', 
        'working_day_record_id', 
        'work_hours', 
        'date',
    ];
}
