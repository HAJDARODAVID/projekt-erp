<?php

namespace App\Services;

use App\Models\User;
use App\Models\Resources;
use App\Models\ModuleItemModel;
use Illuminate\Support\Facades\Auth;
use App\Models\ModuleItemsRouteModel;
use Illuminate\Support\Facades\Session;

/**
 * Class MenuService.
 */
class MenuService
{
    public static function getMenuItems(){
        $appModules = ModuleItemModel::all()->toArray();
        $menuItems = ModuleItemsRouteModel::all();
        $userRights = Session::get('user_rights');
        $resources = Resources::pluck('resources', 'id')->toArray();

        $finalMenuArray = [];

        //CREATE MENU ITEMS STRUCTURE
        foreach ($appModules as $module) {
            $finalMenuArray[$module['id']] = $module;
            $finalMenuArray[$module['id']]['menu_items'] = $menuItems->where('module_id', $module['id'])->toArray();
        }

        //CHECK FOR RIGHTS
        if(Auth::user()->type != User::USER_TYPE_SUPER_ADMIN){
            foreach ($finalMenuArray as $mkey => $module) {
                foreach ($module['menu_items'] as $key => $items) {
                    if(is_null($items['resource_id'])){
                        continue;
                    }
                    if(!in_array($resources[$items['resource_id']], $userRights)){
                        unset($finalMenuArray[$mkey]['menu_items'][$key]);
                    }
                }  
            }
        }

        // REMOVED MODULE IF THERE IS NO ROUTES IN IT
        foreach ($finalMenuArray as $mkey => $module) {
            if(!count($module['menu_items'])){
                unset($finalMenuArray[$mkey]);
            } 
        }

        return $finalMenuArray;
    }

}
