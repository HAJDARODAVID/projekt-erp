<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SpecialPrivilege extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "special_privileges";
    protected $fillable =['user_id', 'resources_id'];

}

