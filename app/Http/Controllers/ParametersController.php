<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;

class ParametersController extends Controller
{
    public function appParams(){
        $isPhone = Agent::isPhone();
        return view('hidro-projekt.ADM.appParams',[
            'isPhone' => $isPhone,
        ]);
    }
}
