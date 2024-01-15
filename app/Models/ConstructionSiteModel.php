<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstructionSiteModel extends Model
{
    use HasFactory;

    protected $table = 'construction_sites';

    protected $fillable = [
        'name',
        'street',
        'town',
        'start_date',
        'end_date',
        'job_description',
        'status',
    ];

}
