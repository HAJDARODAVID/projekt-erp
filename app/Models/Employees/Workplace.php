<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workplace extends Model
{
    use HasFactory;

    protected $table = 'workplaces';

    protected $fillable = ['name', 'status',];

    protected $casts = [
        'status' => 'boolean',
    ];
}
