<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageStockItemsHist extends Model
{
    use HasFactory;

    protected $table = 'storage_stock_items_hist';
    protected $fillable = [
        'inv_id',
        'mat_id',
        'str_loc',
        'cons_id',
        'qty',
    ];
}
