<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IntOrder extends Model
{
    use HasFactory;

    protected $table = 'int_orders';
    protected $fillable = [
        'const_id', 'ordered_by', 'status', 'remark'
    ];

    public function getAllItems(): HasMany{
        return $this->hasMany(IntOrderItem::class, 'ord_id', 'id');
    }

}
