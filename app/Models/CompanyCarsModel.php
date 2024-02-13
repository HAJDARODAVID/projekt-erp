<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCarsModel extends Model
{
    use HasFactory;

    const COMPANY_CAR_STATUS_ACTIVE = 1;
    const COMPANY_CAR_STATUS_INACTIVE = -1;

    const COMPANY_CAR_STATUS = array(
        self::COMPANY_CAR_STATUS_ACTIVE => 'U uporabi',
        self::COMPANY_CAR_STATUS_INACTIVE => 'Van uporabe',
    );

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
