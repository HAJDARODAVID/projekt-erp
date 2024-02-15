<?php

namespace App\Models;

use App\Models\CooperatorWorkersModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function getWorkerInfo():HasOne{
        return $this->hasOne(CooperatorWorkersModel::class, 'id','worker_id');
    }
}
