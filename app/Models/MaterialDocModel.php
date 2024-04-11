<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\HidroProjekt\STG\MovementTypes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialDocModel extends Model
{
    use HasFactory;

    protected $table = 'material_doc';

    protected $fillable = [
        'mvt_type',
        'created_by'
    ];

    public function getFullNameAttribute(){
        return MovementTypes::MVT_DESC_HR[$this->attributes['mvt_type']];
    }

    public function getUserInfo(): HasOne{
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
