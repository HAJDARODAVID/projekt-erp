<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function payrollForMonths(Request $request){
        if(!$request['year']){
            request()->merge(['year'=> date('Y')*1]);
        }
        
        return view('hidro-projekt.HR.payrollForMonths');
    }
}
