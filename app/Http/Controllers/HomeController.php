<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WorkingDayRecordModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','emptyWorkingDay']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->type == User::USER_TYPE_GROUP_LEADER){
            return view('hidro-projekt.BDE.bdeIndex',[
                'myRecords' => WorkingDayRecordModel::where('user_id', Auth::user()->id)->where('date', date('Y-m-d'))->with('getConstructionSite')->get(),
            ]);
        }else{
            return view('hidro-projekt.admin');
        }
        
    }
}
