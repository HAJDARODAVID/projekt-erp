<?php

namespace App\Models\Assets\Vehicles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleMileage extends Model
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
