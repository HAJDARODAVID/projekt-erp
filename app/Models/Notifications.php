<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    const TYPE_SYS_ERROR = 'sys_error';
    const TYPE_INT_ORDER = 'int_order';

    const TYPES_INFO =[
        'int_order' => [
            'name' => 'Interna naruđbenica',
        ],
        self::TYPE_SYS_ERROR => [
            'name' => 'System error',
            'a_type' => 'danger',
        ],
        self::TYPE_INT_ORDER => [
            'name' => 'interna narudžbenica',
            'a_type' => 'primary',
        ],
    ];

    use HasFactory;

    protected $table = 'notifications';
    protected $fillable = ['type', 'message', 'value'];
}
