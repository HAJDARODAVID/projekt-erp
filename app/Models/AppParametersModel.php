<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppParametersModel extends Model
{
    use HasFactory;

    protected $table = 'app_params';
    public $timestamps = false;
    protected $fillable = [
        'param_name',
        'value',
        'active',
    ];
}
