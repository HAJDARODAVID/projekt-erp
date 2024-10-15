<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function materialSale(){
        return view('hidro-projekt.SALES.materialSale');
    }
}
