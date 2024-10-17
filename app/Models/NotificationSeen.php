<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationSeen extends Model
{
    use HasFactory;

    protected $table='notification_seen';
    protected $fillable = [
        'notife_id', 'user_id'
    ];
}
