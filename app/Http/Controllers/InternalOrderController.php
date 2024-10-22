<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InternalOrderController extends Controller
{
    public function bdeOrderForm(){
        return view('hidro-projekt.BDE.internalOrderForm');
    }
}
