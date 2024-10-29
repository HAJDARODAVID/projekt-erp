<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    const TYPE_SYS_ERROR = 'sys_error';
    const TYPE_INT_ORDER = 'int_order';

    const TYPES_INFO =[
        self::TYPE_SYS_ERROR => [
            'name' => 'System error',
            'a_type' => 'danger',
            'moreOption' => NULL,
        ],
        self::TYPE_INT_ORDER => [
            'name' => 'interna narudžbenica',
            'a_type' => 'primary',
            'moreOption' => 'internal-order-info',
        ],
    ];

    use HasFactory;

    protected $table = 'notifications';
    protected $fillable = ['type', 'message', 'value'];
}
