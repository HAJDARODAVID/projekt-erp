<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\InventoryCheckingModel;
use App\Services\HidroProjekt\AdminModuleMenuItemsService;

class AdminModuleMenuItems extends Component
{
    public $menu_items;
    public $moduleItems;
    public $activeInventory;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->menu_items = AdminModuleMenuItemsService::getMenuItems();
        $this->moduleItems = AdminModuleMenuItemsService::getModuleInfo();
        $this->activeInventory = InventoryCheckingModel::where('status', 1)->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-module-menu-items');
    }
}
