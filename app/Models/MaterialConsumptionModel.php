<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialConsumptionModel extends Model
{
    use HasFactory;

    protected $table = 'mat_cons';

    protected $fillable = [
        'wdr_id',
        'booked'
    ];
}
