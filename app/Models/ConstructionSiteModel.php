<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstructionSiteModel extends Model
{
    use HasFactory;

    const CONSTRUCTION_STATUS_DISABLED = -1;
    const CONSTRUCTION_STATUS_ACTIVE = 1;
    const CONSTRUCTION_STATUS_DONE = 2;

    const CONSTRUCTION_STATUS = array(
        self::CONSTRUCTION_STATUS_DISABLED => 'Storno',
        self::CONSTRUCTION_STATUS_ACTIVE => 'Aktivno',
        self::CONSTRUCTION_STATUS_DONE => 'Završeno',
    );

    const CONSTRUCTION_STATUS_COLOR = array(
        self::CONSTRUCTION_STATUS_DISABLED => 'red',
        self::CONSTRUCTION_STATUS_ACTIVE => 'black',
        self::CONSTRUCTION_STATUS_DONE => 'green',
    );

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
