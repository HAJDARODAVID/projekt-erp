<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    const ORDER_PAID   = 'ORD_P';
    const ORDER_UNPAID = 'ORD_UP';
    const ORDER_PAYMENT_STATUS = [
        self::ORDER_PAID   => 'Plaćeno',
        self::ORDER_UNPAID => 'Nije plaćeno',
    ];

    const TRANSACTION_TYPE_CASH    = 'TRANS_TYP_C';
    const TRANSACTION_TYPE_PAYMENT = 'TRANS_TYP_P';
    const TRANSACTION_TYPES = [
        self::TRANSACTION_TYPE_CASH    => 'Gotovina',
        self::TRANSACTION_TYPE_PAYMENT => 'Uplata',
    ];

    use HasFactory;

    protected $table = 'sales_order';
    protected $fillable = ['ord_type', 'buyer', 'pymt_method', 'pymt_status', 'date', 'created_by'];
}
