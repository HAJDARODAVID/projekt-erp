<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\MenuService;
use App\Models\ModuleItemModel;
use App\Models\InventoryCheckingModel;

class MainMenu extends Component
{
    public $preFix=[];
    public $routeName;
    public $menuItems=[];
    public $activeModule;
    public $activeInventory;

    public function mount(){
        $this->preFix = explode("/", request()->route()->getPrefix());
        $this->routeName = request()->route()->getName();
        $this->menuItems = $this->setMenuItems();
        $this->activeModule = $this->setActiveModule();
        $this->activeInventory = InventoryCheckingModel::where('status', 1)->first();
    }

    public function activateModule($module){
        return $this->activeModule = $this->activeModule != $module ? $module : NULL;
    }

    private function setMenuItems(){
        return MenuService::getMenuItems();
    }

    private function setActiveModule(){
        if($this->preFix[0] == ""){
            return NULL;
        }
        return ModuleItemModel::where('module_prefix', strtoupper($this->preFix[0]))->first()->id;
    }

    public function render()
    {
        return view('livewire.main-menu');
    }
}
