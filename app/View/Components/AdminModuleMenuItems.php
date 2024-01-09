<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Services\HidroProjekt\AdminModuleMenuItemsService;

class AdminModuleMenuItems extends Component
{
    public $menuItems;
    public $moduleItems;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->menuItems = AdminModuleMenuItemsService::getMenuItems();
        $this->moduleItems = AdminModuleMenuItemsService::getModuleInfo();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-module-menu-items');
    }
}
