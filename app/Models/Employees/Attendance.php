<?php

namespace App\Models\Employees;

use App\Models\Employees\Worker;
use App\Models\WorkingDayRecordModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
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

    public function getWorkerInfo(): HasOne
    {
        return $this->hasOne(Worker::class, 'id', 'worker_id');
    }

    public function getWDRInfo(): HasOne
    {
        return $this->hasOne(WorkingDayRecordModel::class, 'id', 'working_day_record_id');
    }
}
