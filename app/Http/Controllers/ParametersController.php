<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParametersController extends Controller
{
    public function appParams(){
        return view('hidro-projekt.ADM.appParams');
    }
}
