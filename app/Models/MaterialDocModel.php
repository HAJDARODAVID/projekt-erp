<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialDocModel extends Model
{
    use HasFactory;

    protected $table = 'material_doc';

    protected $fillable=[
        'mvt_type',
        'created_by'
    ];
}
