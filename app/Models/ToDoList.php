<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    const STATUS_CANCELED = -1;
    const STATUS_ACTIVE   = 1;
    const STATUS_FINISHED = 2;

    const PRIORITY_LOW    = 10;
    const PRIORITY_MEDIUM = 20;
    const PRIORITY_HIGH   = 30;

    const STATUS = [
        self::STATUS_CANCELED => 'Otkazano',
        self::STATUS_ACTIVE   => 'Aktivno',
        self::STATUS_FINISHED => 'Završeno',
    ];

    const PRIORITY = [
        self::PRIORITY_LOW    => 'Low',
        self::PRIORITY_MEDIUM => 'Medium',
        self::PRIORITY_HIGH   => 'High',
    ];

    const PRIORITY_HR = [
        self::PRIORITY_LOW    => 'Nisko',
        self::PRIORITY_MEDIUM => 'Srednje',
        self::PRIORITY_HIGH   => 'Visoko',
    ];

    use HasFactory;

    protected $table = 'to_do_list';
    protected $fillable=[
        'user_id', 'from', 'task', 'status', 'priority', 'deadline'
    ];
}
