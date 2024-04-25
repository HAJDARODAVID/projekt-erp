<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StorageStockItem extends Model
{
    use HasFactory;

    const STORAGE_LOCATION_TYPE_HALL = 1;
    const STORAGE_LOCATION_TYPE_CONS_SITE = 5;

    const STORAGE_LOCATION = [
        self::STORAGE_LOCATION_TYPE_HALL      => 'Skladište',
        self::STORAGE_LOCATION_TYPE_CONS_SITE => 'Gradilište',
    ];

    protected $table = 'storage_stock_items';
    protected $fillable = [
        'mat_id',
        'str_loc',
        'cons_id',
        'qty',
    ];

    public function getMaterialInfo(): HasOne{
        return $this->hasOne(MaterialMasterData::class, 'id', 'mat_id');
    }

    public function getConstructionSiteInfo(): HasOne{
        return $this->hasOne(ConstructionSiteModel::class, 'id', 'cons_id');
    }

    public function getCostAttribute(){
        $materialPrice = MaterialMasterData::where('id', $this->attributes['mat_id'])->first()->price;
        $amount = $this->attributes['qty']*$materialPrice;
        return $amount;
    }
}
