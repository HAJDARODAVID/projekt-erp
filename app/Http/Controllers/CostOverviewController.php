<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CostOverviewController extends Controller
{
    public function billOverview(){
        $user=Auth::user();
        if($user->id != 1 && $user->id != 2 && $user->id != 4){
            return redirect()->route('home');
        }
        return view('hidro-projekt.COSTS.billOverview');
    }
}
