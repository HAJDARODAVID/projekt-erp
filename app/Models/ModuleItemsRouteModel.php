<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModuleItemsRouteModel extends Model
{
    use HasFactory;

    protected $table = 'module_item_routes';

    protected $fillable = [
        'name', 'route_name', 'module_id', 'resource_id',
    ];

    public $timestamps = false;

    /**
     * Get the user that owns the ModuleItemsRouteModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getOwner(): BelongsTo
    {
        return $this->belongsTo(ModuleItemModel::class, 'module_id', 'id');
    }
}
