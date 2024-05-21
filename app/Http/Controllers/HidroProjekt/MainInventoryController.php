<?php

namespace App\Http\Controllers\HidroProjekt;

use App\Http\Controllers\Controller;
use App\Models\InventoryCheckingModel;
use Illuminate\Http\Request;

class MainInventoryController extends Controller
{
    public function index(){
        $activeInventory = InventoryCheckingModel::where('status', 1)->first();
        return view('hidro-projekt.ADM.mainInventory',[
            'activeInventory' => $activeInventory,
        ]);
    }

    public function inventoryResults(){
        return 'im results';
    }
}
