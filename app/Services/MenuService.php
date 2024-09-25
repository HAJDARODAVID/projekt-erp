<?php

namespace App\Services;

use App\Models\ModuleItemModel;
use App\Models\ModuleItemsRouteModel;
use App\Models\Resources;
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
        return $finalMenuArray;
    }

}