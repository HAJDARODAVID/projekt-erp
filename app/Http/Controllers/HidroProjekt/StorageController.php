<?php

namespace App\Http\Controllers\HidroProjekt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function storageStockItems(){
        return view('hidro-projekt.STG.stockItems');
    }
}
