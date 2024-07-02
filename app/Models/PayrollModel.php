<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PayrollModel extends Model
{
    use HasFactory;

    protected $table = 'payroll';

    protected $fillable = [
        'month', 
        'year', 
        'locked'
    ];

    public function getPayrollItems():HasMany{
        return $this->hasMany(PayrollItemsModel::class, 'payroll_id', 'id');
    }

    public function getDeductions():HasMany{
        return $this->hasMany(PayrollDeductionModel::class, 'payroll_id', 'id');
    }
}
