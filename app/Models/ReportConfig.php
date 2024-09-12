<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportConfig extends Model
{
    use HasFactory;

    protected $table = 'report_configs';
    protected $fillable = [
        'r_name', 'r_long_name', 'value_1', 'value_2', 'value_3'
    ];
}
