<?php

namespace App\Services\HidroProjekt\ADM;

use App\Models\InventoryCheckingModel;
use Illuminate\Support\Facades\Auth;

/**
 * Class MainInventoryService.
 */
class MainInventoryService
{
    public function openNewInventoryCheck($invName){
        $newInvCheck = InventoryCheckingModel::create([
            'inv_name' => $invName,
            'status' => InventoryCheckingModel::INVENTORY_STATUS_ACTIVE,
            'created_by' => Auth::user()->id,
        ]);
        return;
    }

}
