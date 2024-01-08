<?php

namespace App\Services\HidroProjekt;

use App\Models\ModuleItemModel;
use App\Models\ModuleItemsRouteModel;
use Illuminate\Support\Facades\Auth;

/**
 * Class AdminModulemenuItemsService.
 */
class AdminModuleMenuItemsService
{
    public static function getMenuItems(){
        $user = Auth::user();
        $menuItems = ModuleItemsRouteModel::with('getOwner')->get()->toArray();
        $finalArray = [];
        foreach ($menuItems as $menuItem) {
            $finalArray[$menuItem['get_owner']['name']][] = $menuItem;
        }
        return $finalArray;
    }

    public static function getModuleInfo(){
        $moduleItems = ModuleItemModel::get()->toArray();
        $finalArray = [];
        foreach ($moduleItems as $items) {
            $finalArray[$items['name']] = $items['module_prefix'];
        }
        return $finalArray;
    }
}
