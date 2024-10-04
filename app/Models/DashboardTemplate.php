<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardTemplate extends Model
{
    use HasFactory;

    protected $table = 'dashboard_templates';
    public $timestamps = false;
    protected $fillable=[
        'layout_name', 'temp'
    ];

    public function getTemplateArray(){
        return json_decode($this->attributes['temp'],true);
    }
}
