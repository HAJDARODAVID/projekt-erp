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

    public function materialInventoryResults(){
        return 'im results';
    }

    public function activeInventoryChecking($inv_name){
        $activeInventory = InventoryCheckingModel::where('inv_name', $inv_name)->where('status', InventoryCheckingModel::INVENTORY_STATUS_ACTIVE)->first();
        if(!$activeInventory){
            return redirect()->route('home');
        }
        dd($activeInventory);
    }
}
