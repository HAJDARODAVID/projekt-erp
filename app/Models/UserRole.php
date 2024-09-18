<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserRole extends Model
{
    use HasFactory;

    protected $table = "user_roles";
    protected $fillable =['user_id', 'role_id'];

    public function getRoles():HasOne{
        return $this->hasOne(RoleGroup::class, 'id', 'role_id');
    }
}
