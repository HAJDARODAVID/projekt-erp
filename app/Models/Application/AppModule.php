<?php

namespace App\Models\Application;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppModule extends Model
{
    use HasFactory;
    protected $table = 'app_modules';
    protected $fillable = ['name', 'module', 'controller', 'active'];

    public $incrementing = FALSE;

    protected static function booted(): void
    {
        static::creating(function (AppModule $appModule) {
            $appModule->id = Str::uuid()->toString();
        });
    }

    protected $casts = [
        'active' => 'boolean',
    ];
}
