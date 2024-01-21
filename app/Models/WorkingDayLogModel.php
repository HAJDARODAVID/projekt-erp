<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingDayLogModel extends Model
{
    use HasFactory;

    protected $table = 'working_day_log';

    protected $fillable = [
        'working_day_record_id',
        'construction_site_id',
        'log',
    ];
}
