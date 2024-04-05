<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabItems extends Model
{
    use HasFactory;

    protected $table = 'tabs_items';
    protected $fillable = [
        'comp_name',
        'route_name',
        'order',
    ];

    public $timestamps = false;
}
