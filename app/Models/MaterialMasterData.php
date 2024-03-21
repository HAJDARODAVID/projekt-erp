<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialMasterData extends Model
{
    use HasFactory;

    protected $table = 'mm';

    protected $fillable = [
        'mm_uid', 
        'name', 
        'oem', 
        'supplier', 
        'uom_1', 
        'price'
    ];
}
