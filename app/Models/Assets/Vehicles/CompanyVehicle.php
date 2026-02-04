<?php

namespace App\Models\Assets\Vehicles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyVehicle extends Model
{
    use HasFactory;

    protected $table = 'company_cars';
    protected $fillable = [
        'car_plates',
        'brand',
        'model',
        'valid_to',
        'active',
        'avatar',
        'last_service_at',
        'service_every',
    ];
}
