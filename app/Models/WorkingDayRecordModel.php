<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingDayRecordModel extends Model
{
    use HasFactory;

    protected $table ="working_day_record";

    protected $fillable = [
        'user_id',
        'construction_site_id',
        'car_id',
        'date',
        'work_description',
    ];

}
