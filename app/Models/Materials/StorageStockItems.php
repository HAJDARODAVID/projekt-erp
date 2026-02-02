<?php

namespace App\Models\Materials;

use Illuminate\Database\Eloquent\Model;
use App\Models\Materials\MaterialMasterData;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StorageStockItems extends Model
{
    use HasFactory;

    protected $table = 'storage_stock_items';
    protected $fillable = [
        'mat_id',
        'str_loc',
        'cons_id',
        'qty',
    ];

    public function getMaterialInfo(): HasOne
    {
        return $this->hasOne(MaterialMasterData::class, 'id', 'mat_id');
    }

    // public function getConstructionSiteInfo(): HasOne{
    //     return $this->hasOne(ConstructionSiteModel::class, 'id', 'cons_id');
    // }

    // public function getCostAttribute(){
    //     $materialPrice = MaterialMasterData::where('id', $this->attributes['mat_id'])->first()->price;
    //     $amount = $this->attributes['qty']*$materialPrice;
    //     return $amount;
    // }
}
