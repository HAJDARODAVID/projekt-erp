<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function getWorkerInfo():HasOne{
        return $this->hasOne(WorkerModel::class, 'id','worker_id');
    }


}
