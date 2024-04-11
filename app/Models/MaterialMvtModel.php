<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialMvtModel extends Model
{
    use HasFactory;

    protected $table = 'material_mvt';

    protected $fillable = [
        'stg_loc', 'const_id', 'mvt', 'mat_doc_id', 'mat_id', 'qty'
    ];

    public function getMaterialInfo(): HasOne{
        return $this->hasOne(MaterialMasterData::class, 'id', 'mat_id');
    }
}
