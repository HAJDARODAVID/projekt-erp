<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpecialPrivilege extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "special_privileges";
    protected $fillable =['user_id', 'resources_id'];

    public function getResources():HasMany{
        return $this->hasMany(Resources::class, 'id', 'resources_id');
    }

}

