<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstructionSiteConsumptionModel extends Model
{
    use HasFactory;

    protected $table = 'construction_site_consumption_view';

    public function getCostAttribute(){
        $materialPrice = MaterialMasterData::where('id', $this->attributes['mat_id'])->first()->price;
        $amount = $this->attributes['qty']*$materialPrice;
        return $amount;
    }
}
