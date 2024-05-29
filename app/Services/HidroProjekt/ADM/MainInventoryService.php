<?php

namespace App\Services\HidroProjekt\ADM;

use App\Models\InventoryCheckingItem;
use App\Models\InventoryCheckingModel;
use App\Services\HidroProjekt\STG\StorageLocation;
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

    public function addItemsToInventoryList($items, $loc, $user, $activeInventory){
        $strLoc = NULL;
        $consSite = NULL;
        if($loc == 'main_storage'){
            $strLoc = StorageLocation::MAIN_STORAGE;
        }else{
            $strLoc = StorageLocation::CONSTRUCTION_SITE;
            $consSite = $loc;
        }

        foreach($items as $item){
            InventoryCheckingItem::create([
                'inv_id'  => $activeInventory->id,
                'mat_id'  => $item['mat_id'],
                'qty'     => $item['qty'],
                'user_id' => $user,
                'str_loc' => $strLoc,
                'cons_id' => $consSite,
            ]);
        }

        return TRUE;
    }

}
