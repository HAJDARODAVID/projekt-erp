<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCarsModel extends Model
{
    use HasFactory;

    protected $table = 'company_cars';
    protected $fillable = [
        'car_plates',
        'brand',
        'model',
        'valid_to',
    ];
}
