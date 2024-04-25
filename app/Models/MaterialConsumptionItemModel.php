<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialConsumptionItemModel extends Model
{
    use HasFactory;

    protected $table = 'mat_cons_items';

    protected $fillable = [
        'mat_cons_id',
        'mat_id',
        'qty'
    ];
}
