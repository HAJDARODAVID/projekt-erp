<?php

namespace App\Livewire\Modules\AppSettings;

use App\Models\Application\AppModule;
use Livewire\Attributes\Url;
use App\Livewire\LivewireController;
use App\Services\Application\Settings\GetAppModuleService;
use App\Services\Application\Settings\EditAppModuleService;

class Modules extends LivewireController
{
    #[Url('search')]
    public $moduleSearch = NULL;

    /**Registered app modules */
    public $appModules = [];

    /**Selected app module */
    #[Url('module')]
    public $selectedAppModule = NULL;

    public function mount()
    {
        $this->getAppModules();

        /**If the $selectedAppModule is set heck if the module exists */
        if ($this->selectedAppModule) {
            $appModule = GetAppModuleService::byId($this->selectedAppModule);
            $this->selectedAppModule = $appModule->exists() ? $this->selectedAppModule : NULL;
        }
    }

    public function updatedModuleSearch($value)
    {
        if ($value == "") $this->moduleSearch = NULL;
        $this->getAppModules();
    }

    /**
     * Select a application module and show more info 
     */
    public function selectAppModule($uuid)
    {
        if ($this->selectedAppModule == $uuid) {
            $this->selectedAppModule = NULL;
        } else {
            /**Check if the module exists */
            $appModule = GetAppModuleService::byId($uuid);
            $this->selectedAppModule = $appModule->exists() ? $uuid : NULL;
        }
    }

    public function updatedAppModules($value, $key)
    {
        list($moduleKey, $column) = explode('.', $key);
        $editAppModuleService = app(EditAppModuleService::class)->ofId($this->appModules[$moduleKey]['id']);
        switch ($column) {
            case 'active':
                if ($value == TRUE) $editAppModuleService = $editAppModuleService->activate();
                if ($value == FALSE) $editAppModuleService = $editAppModuleService->deactivate();

                if ($editAppModuleService['success']) {
                    return $this->dispatch('notify', ['message' => 'Successfully changed the module status!', 'type' => 'success']);
                } else {
                    return $this->dispatch('show-exception-modal', $editAppModuleService['error']);
                }
                break;
        }
    }

    /**
     * Get all app module.
     * This will consider $this->moduleSearch property
     */
    private function getAppModules()
    {
        $appModule = new AppModule();
        if ($this->moduleSearch) {
            $appModule = $appModule->where('name', 'LIKE', '%' . $this->moduleSearch . '%')->orWhere('module', 'LIKE', '%' . $this->moduleSearch . '%')->orWhere('controller', 'LIKE', '%' . $this->moduleSearch . '%');
        }
        return $this->appModules = $appModule->select('id', 'name', 'active')->get()->toArray();
    }

    /**
     *  This will be used for resetting the moduleSearch property.
     */
    public function resetModuleSearchInput()
    {
        $this->reset('moduleSearch');
        return $this->getAppModules();
    }

    public function render()
    {
        $this->getAppModules();
        return view('livewire.modules.app-settings.modules');
    }
}
