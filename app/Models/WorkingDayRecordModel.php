<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkingDayRecordModel extends Model
{
    use HasFactory;

    const WORK_TYPE_HOME       = 1;
    const WORK_TYPE_FIELD_WORK = 2;
    const WORK_TYPE_MISC_WORK  = 3;

    const WORK_TYPE = array(
        self::WORK_TYPE_HOME       => 'Doma',
        self::WORK_TYPE_FIELD_WORK => 'Teren',
        self::WORK_TYPE_MISC_WORK  => 'Režija',
    );

    const MISC_WORK_LIST = array(
        532 => 'Čret',
    );

    const BDE_WORK_TYPES = array(
        self::WORK_TYPE_HOME,
        self::WORK_TYPE_FIELD_WORK,
    );

    protected $table ="working_day_record";

    protected $fillable = [
        'user_id',
        'construction_site_id',
        'car_id',
        'date',
        'work_description',
        'work_type',
    ];

    public function getConstructionSite():HasOne{
        return $this->hasOne(ConstructionSiteModel::class, 'id','construction_site_id');
    }

    public function getUser():HasOne{
        return $this->hasOne(User::class, 'id','user_id');
    }

    public function getLogs():HasMany{
        return $this->hasMany(WorkingDayLogModel::class, 'working_day_record_id', 'id')->orderBy('id','desc');
    }

    public function getAttendance():HasMany{
        return $this->hasMany(AttendanceModel::class, 'working_day_record_id', 'id');
    }

    public function getAttendanceCoOp():HasMany{
        return $this->hasMany(AttendanceCoOpModel::class, 'working_day_record_id', 'id');
    }

    public function getCarMileage():HasMany{
        return $this->hasMany(CarMileageModel::class, 'wdr_id', 'id');
    }


}
