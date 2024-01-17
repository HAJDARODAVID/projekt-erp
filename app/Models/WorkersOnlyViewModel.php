<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkersOnlyViewModel extends Model
{
    use HasFactory;

    protected $table = "workersonlyview";
}
