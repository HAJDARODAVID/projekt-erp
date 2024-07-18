<?php

namespace App\Http\Controllers;

use App\Services\Days;
use Illuminate\Http\Request;

class EmployeeTimeTrackerController extends Controller
{
    public function employeeTimeTracker(Request $request){
        if(!$request['year']){
            request()->merge(['year'=> date('Y')*1]);
        }
        if(!$request['month']){
            request()->merge(['month'=> date('m')*1]);
        }
        return view('hidro-projekt.BDE.bdeEmployeeTimeTracker');
    }
}
