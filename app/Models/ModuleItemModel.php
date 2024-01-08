<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModuleItemModel extends Model
{
    use HasFactory;

    protected $table = 'module_items';

    public function getModuleRoutes():HasMany{
        return $this->hasMany(ModuleItemsRouteModel::class, 'module_id','id');
    }
}
