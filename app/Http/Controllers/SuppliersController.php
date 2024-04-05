<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function index(){
        return view('hidro-projekt.ADM.suppliers');
    }

    public function newSupplier(){
        return view('hidro-projekt.ADM.newSuppliers');
    }
}
