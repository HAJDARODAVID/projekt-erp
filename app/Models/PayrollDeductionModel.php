<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollDeductionModel extends Model
{
    use HasFactory;

    protected $table = 'payroll_deductions';

    protected $fillable = [
        'payroll_id', 
        'worker_id', 
        'amount', 
        'reason'
    ];
}
