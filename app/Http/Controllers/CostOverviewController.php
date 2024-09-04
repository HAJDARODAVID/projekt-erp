<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CostOverviewController extends Controller
{
    public function billOverview(){
        return view('hidro-projekt.COSTS.billOverview');
    }
}
