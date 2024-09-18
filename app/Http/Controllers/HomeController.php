<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SpecialPrivilege;
use Jenssegers\Agent\Facades\Agent;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkingDayRecordModel;
use App\Models\InventoryCheckingModel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

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

        $invokeUserRightsUpdate = Auth::user()->inv_update;
        if(!Session::get('user_rights') || $invokeUserRightsUpdate){
            Session::put('user_rights', $this->getUserRights());
            if($invokeUserRightsUpdate){
                Artisan::call('view:clear');
                User::where('id', Auth::user()->id)->first()->update([
                    'inv_update' => FALSE,
                ]);
            }
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

    private function getUserRights(){
        $user = Auth::user();
        $userRights=[];
        $userInfo = User::where('id', $user->id)
            ->with(
                'getSpecialPrivilege', 
                'getSpecialPrivilege.getResources',
                'getUserRoles.getRoles.getRoleResources.getResource'
                )
            ->first();
        $specialPrivileges = $userInfo->getSpecialPrivilege;
        $roles =  $userInfo->getUserRoles;
        //Get special privileges
        foreach ($specialPrivileges as $resource) {
            $userRights[]=$resource->getResources->first()->resources;
        }
        //dd($roles);
        //Get roles privileges
        foreach ($roles as $role) {
            foreach ($role->getRoles->getRoleResources as $resource) {
                $userRights[]=$resource->getResource->resources;
            }
        }
        //remove duplicates
        $userRights = array_unique($userRights);
        return $userRights;
    }
}
