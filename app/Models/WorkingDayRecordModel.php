<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkingDayRecordModel extends Model
{
    use HasFactory;

    const WORK_TYPE_HOME = 1;
    const WORK_TYPE_FIELD_WORK = 2;

    const WORK_TYPE = array(
        self::WORK_TYPE_HOME => 'Doma',
        self::WORK_TYPE_FIELD_WORK => 'Teren',
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


}
