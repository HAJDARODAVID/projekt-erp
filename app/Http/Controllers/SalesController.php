<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function cashRegister(){
        return view('hidro-projekt.SALES.cashRegister');
    }
}
