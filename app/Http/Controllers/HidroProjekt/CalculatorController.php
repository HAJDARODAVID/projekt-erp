<?php

namespace App\Http\Controllers\HidroProjekt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index(){
        return view('hidro-projekt.ADM.calculator');
    }
}
