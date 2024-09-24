<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RoleResource extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "role_resources";
    protected $fillable =['role_id', 'resources_id'];

    public function getResource():HasOne{
        return $this->hasOne(Resources::class, 'id', 'resources_id');
    }
}