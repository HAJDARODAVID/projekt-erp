<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialMvtModel extends Model
{
    use HasFactory;

    protected $table = 'material_mvt';

    protected $fillable = [
        'stg_loc', 'const_id', 'mvt', 'mat_doc_id', 'mat_id', 'qty'
    ];
}
