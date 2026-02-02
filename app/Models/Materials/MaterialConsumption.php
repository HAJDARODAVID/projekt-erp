<?php

namespace App\Models\Materials;

use Illuminate\Database\Eloquent\Model;
use App\Models\Materials\MaterialConsumptionItem;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialConsumption extends Model
{
    use HasFactory;

    //TODO: move this to a seperate file
    const STATUS_UNBOOKED = 0;
    const STATUS_BOOKED   = 1;

    protected $table = 'mat_cons';

    protected $fillable = [
        'wdr_id',
        'mat_doc_id',
        'booked'
    ];

    public function getConsumptionItems(): HasMany
    {
        return $this->hasMany(MaterialConsumptionItem::class, 'mat_cons_id', 'id');
    }
}
