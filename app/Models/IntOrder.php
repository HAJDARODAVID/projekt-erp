<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class IntOrder extends Model
{
    use HasFactory;

    const STATUS_OPEN     = 1;
    const STATUS_CLOSED   = 2;
    const STATUS_CANCELED = -1;

    const STATUS_TYPES = [
        self::STATUS_OPEN     => 'Otvoreno',
        self::STATUS_CLOSED   => 'Zatvoreno',
        self::STATUS_CANCELED => 'Storno',
    ];

    protected $table = 'int_orders';
    protected $fillable = [
        'const_id', 'ordered_by', 'status', 'remark'
    ];

    public function getAllItems(): HasMany{
        return $this->hasMany(IntOrderItem::class, 'ord_id', 'id');
    }

    public function getUserIfo(): HasOne{
        return $this->hasOne(User::class, 'id', 'ordered_by');
    }

}
