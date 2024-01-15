<?php

namespace App\Http\Controllers\HidroProjekt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WorkingDayRecordModel;
use Illuminate\Support\Facades\Auth;

class WorkDayRecordController extends Controller
{
    public function index(){
        return "test";
    }

    public function newWorkingDayEntry(){
        if(Auth::user()->type == 3){
            WorkingDayRecordModel::create([
                'user_id' => Auth::user()->id,
                'date' => date('Y-m-d'),
            ]);
            return redirect()->route('home');
        }else{
            return redirect()->route('home');
        }
    }
}
