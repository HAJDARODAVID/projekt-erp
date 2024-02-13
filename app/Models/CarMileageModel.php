<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarMileageModel extends Model
{
    use HasFactory;

    protected $table = 'company_cars_mileage';
    protected $fillable = [
        'car_id', 
        'wdr_id', 
        'start_mileage', 
        'end_mileage'
    ];
}
