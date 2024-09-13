<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialMasterData extends Model
{
    use HasFactory;

    protected $table = 'mm';

    protected $fillable = [
        'mm_uid', 
        'name', 
        'oem', 
        'supplier_id', 
        'uom_1', 
        'price',
        'active',
    ];

    protected $casts = [
        'active' => 'bool',
    ];

    public function getSupplier(): HasOne
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

    // public function getFullNameAttribute(){
    //     return $this->attributes['id'] . ' ' .  $this->attributes['name'];
    // }
}
