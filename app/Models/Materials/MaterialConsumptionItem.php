<?php

namespace App\Models\Materials;

use Illuminate\Database\Eloquent\Model;
use App\Models\Materials\MaterialMasterData;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialConsumptionItem extends Model
{
    use HasFactory;

    protected $table = 'mat_cons_items';

    protected $fillable = [
        'mat_cons_id',
        'mat_id',
        'qty'
    ];

    public function getCostAttribute()
    {
        $materialPrice = MaterialMasterData::where('id', $this->attributes['mat_id'])->first()->price;
        $amount = $this->attributes['qty'] * $materialPrice;
        return $amount;
    }
}
