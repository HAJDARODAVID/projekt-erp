<?php

namespace App\Services\HidroProjekt\ADM;

use App\Models\InventoryCheckingItem;
use App\Models\InventoryCheckingModel;
use App\Models\MaterialDocModel;
use App\Models\MaterialMvtModel;
use App\Models\StorageStockItem;
use App\Models\StorageStockItemsHist;
use App\Services\HidroProjekt\STG\MovementTypes;
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

    public function bookMainInventory($activeInventory){
        $oldStockItems = StorageStockItem::where('qty','>', 0)->get();
        $invItems = InventoryCheckingItem::where('inv_id', $activeInventory->id)->get();

        $newMovement = MaterialDocModel::create([
            'mvt_type' => MovementTypes::BOOK_INVENTORY_REMOVE_STOCK,
            'created_by' => Auth::user()->id,
        ]);

        foreach ($oldStockItems as $item) {
            //Archive old stock item
            StorageStockItemsHist::create([
                'inv_id' => $activeInventory->id,
                'mat_id' => $item->mat_id,
                'str_loc' => $item->str_loc,
                'cons_id' => $item->cons_id,
                'qty' => $item->qty,
            ]);

            //Add to material movement table
            MaterialMvtModel::create([
                'stg_loc' => $item->str_loc, 
                'const_id' => $item->cons_id, 
                'mvt' => $newMovement->mvt_type, 
                'mat_doc_id' => $newMovement->id, 
                'mat_id' => $item->mat_id, 
                'qty' => $item->qty,
            ]);

            //Set stoke item to 0 
            $item->update([
                'qty' => 0,
            ]);
        }
        return true;
        dd($invItems);
    }

}
