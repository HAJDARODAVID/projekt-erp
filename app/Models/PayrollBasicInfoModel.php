<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollBasicInfoModel extends Model
{
    use HasFactory;
    protected $table = 'payroll_basic_info';

    protected $attributes = [
        'travel_exp' => 0,
        'phone_exp'  => 0,
    ];

    protected $casts = [
        'bonus' => 'bool',
      ];

    protected $fillable = [
        'worker_id',
        'h_rate', 
        'fix_rate', 
        'travel_exp', 
        'phone_exp',
        'bonus',
    ];
}
