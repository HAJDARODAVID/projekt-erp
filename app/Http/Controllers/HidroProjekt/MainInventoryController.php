<?php

namespace App\Http\Controllers\HidroProjekt;

use App\Http\Controllers\Controller;
use App\Models\InventoryCheckingModel;
use Illuminate\Http\Request;

class MainInventoryController extends Controller
{
    public function materialChecking(){
        $activeInventory = InventoryCheckingModel::where('status', 1)->first();
        return view('hidro-projekt.ADM.mainInventory',[
            'activeInventory' => $activeInventory,
        ]);
    }

    public function materialInventoryResults(Request $request){
        dd($request->all());
    }

    public function activeInventoryChecking($inv_name){
        $activeInventory = InventoryCheckingModel::where('inv_name', $inv_name)->where('status', InventoryCheckingModel::INVENTORY_STATUS_ACTIVE)->first();
        if(!$activeInventory){
            return redirect()->route('home');
        }
        return view('hidro-projekt.ADM.activeInventoryChecking', [
            'activeInventory' => $activeInventory
        ]);
    }

    public function activeInventoryCheckingList(Request $request){
        $activeInventory = InventoryCheckingModel::where('inv_name', $request->inv_name)->where('status', InventoryCheckingModel::INVENTORY_STATUS_ACTIVE)->first();
        if(!$activeInventory){
            return redirect()->route('home');
        }
        return view('hidro-projekt.ADM.activeInventoryCheckingList', [
            'activeInventory' => $activeInventory
        ]);
    }

    public function inventoryQrReader(Request $request){
        $activeInventory = InventoryCheckingModel::where('inv_name', $request->inv_name)->where('status', InventoryCheckingModel::INVENTORY_STATUS_ACTIVE)->first();
        if(!$activeInventory){
            return redirect()->route('home');
        }
        return 'im home';
    }
}
