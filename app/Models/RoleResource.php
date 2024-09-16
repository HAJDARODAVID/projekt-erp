<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleResource extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "role_resources";
    protected $fillable =['role_id', 'resources_id'];
}