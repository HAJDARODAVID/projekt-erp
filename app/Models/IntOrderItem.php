<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntOrderItem extends Model
{
    use HasFactory;

    protected $table='int_orders_items';
    protected $fillable = [
        'ord_id', 'mat_id', 'qty'
    ];
    public $timestamps = false;
}
