<?php

namespace App\Models;

use App\Models\WorkingDayRecordModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkingDayLogModel extends Model
{
    use HasFactory;

    protected $table = 'working_day_log';

    protected $fillable = [
        'working_day_record_id',
        'construction_site_id',
        'log',
    ];

    public function getWorkingDayRecord():HasOne{
        return $this->hasOne(WorkingDayRecordModel::class, 'id','working_day_record_id');
    }
}
