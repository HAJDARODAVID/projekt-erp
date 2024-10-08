<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BillModel extends Model
{
    use HasFactory;

    protected $table = 'bills';

    protected $fillable = [
        'provider_id', 'categories_id', 'amount', 'date', 'remark', 'inc_pdv'
    ];

    protected $casts = [
        'inc_pdv' => 'bool',
      ];

    public function getProvider():HasOne{
        return $this->hasOne(BillProviderModel::class, 'id','provider_id');
    }

    public function getCategory():HasOne{
        return $this->hasOne(BillCategoryModel::class, 'id','categories_id');
    }

    public function getAmountWithoutPdvAttribute(){
        if($this->inc_pdv){
            return $this->amount * 0.8;
        }
        return $this->amount;
    }
}
