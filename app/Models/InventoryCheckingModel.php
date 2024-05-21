<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryCheckingModel extends Model
{
    use HasFactory;

    const INVENTORY_STATUS_ACTIVE   = 1;
    const INVENTORY_STATUS_BOOKED   = 2;
    const INVENTORY_STATUS_CANCELED = -1;

    const INVENTORY_STATUS = [
        self::INVENTORY_STATUS_ACTIVE   => 'Active',
        self::INVENTORY_STATUS_BOOKED   => 'Booked',
        self::INVENTORY_STATUS_CANCELED => 'Canceled'
    ];

    protected $table = 'inventory_checking';

    protected $fillable = [
        'inv_name',
        'status',
        'created_by',
    ];
}
