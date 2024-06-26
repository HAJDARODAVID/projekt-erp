<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkingDayRecordModel;
use App\Models\InventoryCheckingModel;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Facades\Agent;

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
        //Check if the user is on phone, and put into session
        if(!Session::get('is_phone')){
            Session::put('is_phone', Agent::isPhone());
        }

        if(!Session::get('user_rights')){
            
        }
        if(Auth::user()->type == User::USER_TYPE_GROUP_LEADER){
            return view('hidro-projekt.BDE.bdeIndex',[
                'myRecords' => WorkingDayRecordModel::where('user_id', Auth::user()->id)->where('date', date('Y-m-d'))->with('getConstructionSite')->get(),
                'activeInv' => InventoryCheckingModel::where('status', InventoryCheckingModel::INVENTORY_STATUS_ACTIVE)->first(),
            ]);
        }else{
            return view('hidro-projekt.admin');
        }
        
    }
}
