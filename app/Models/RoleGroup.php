<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoleGroup extends Model
{
    use HasFactory;

    protected $table = "role_groups";
    protected $fillable =['name', 'name_hr'];

    public function getRoleResources():HasMany{
        return $this->hasMany(RoleResource::class, 'role_id', 'id');
    }

}