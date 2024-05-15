<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaterialConsumptionModel extends Model
{
    use HasFactory;

    const STATUS_UNBOOKED = 0;
    const STATUS_BOOKED   = 1;

    protected $table = 'mat_cons';

    protected $fillable = [
        'wdr_id',
        'booked'
    ];

    public function getConsumptionItems(): HasMany{
        return $this->hasMany(MaterialConsumptionItemModel::class, 'mat_cons_id', 'id');
    }
}
