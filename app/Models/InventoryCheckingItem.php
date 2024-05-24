<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryCheckingItem extends Model
{
    use HasFactory;

    protected $table = 'inventory_checking_items';

    protected $fillable = [
        'inv_id', 
        'mat_id', 
        'qty', 
        'user_id', 
        'str_loc', 
        'cons_id'
    ];

    public function getMaterialInfo(): HasOne{
        return $this->hasOne(MaterialMasterData::class, 'id','mat_id');
    }

    public function getConstructionSiteInfo(): HasOne{
        return $this->hasOne(ConstructionSiteModel::class, 'id','cons_id');
    }

    public function getUserInfo(): HasOne{
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
