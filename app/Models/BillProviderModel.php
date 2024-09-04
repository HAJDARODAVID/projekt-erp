<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillProviderModel extends Model
{
    use HasFactory;

    protected $table = 'bill_providers';

    protected $fillable = [
        'provider'
    ];
}
