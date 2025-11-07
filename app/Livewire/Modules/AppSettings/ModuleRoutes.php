<?php

namespace App\Livewire\Modules\AppSettings;

use Livewire\Attributes\Url;
use App\Livewire\LivewireController;
use Illuminate\Support\Facades\Route;
use App\Models\Application\AppModuleRoute;
use App\Services\Application\Settings\EditAppModuleRouteService;
use App\Services\Application\Settings\GetAppModuleRoutesService;

class ModuleRoutes extends LivewireController
{
    /**This will be pass thru */
    public $moduleID;

    #[Url('route-search')]
    public $routeSearch = NULL;

    /**Selected app module route*/
    #[Url('module-route')]
    public $selectedModuleRoute = NULL;

    /**Registered app modules routes */
    public $appModuleRoutes;

    public function mount()
    {
        $this->setTabs([
            'module-routes-info' => 'Route info',
            'module-routes-components' => 'Components',
        ]);
    }

    /**
     * Get all app module routes.
     * This will consider $this->routeSearch property
     */
    private function getAppModulesRoutes()
    {
        /**
         * Check if the selected route exists
         */
        $appModuleRoutesCheck = GetAppModuleRoutesService::byId($this->selectedModuleRoute)->getAppModuleRoutesModel();
        if ($appModuleRoutesCheck) {
            $this->selectedModuleRoute = $appModuleRoutesCheck->module_id != $this->moduleID ? NULL : $this->selectedModuleRoute;
            $this->routeSearch = NULL;
        }

        $appModuleRoutes = AppModuleRoute::where('module_id', $this->moduleID);
        if ($this->routeSearch) {
            $appModuleRoutes->where(function ($q) {
                $q->where('title', 'LIKE', '%' . $this->routeSearch . '%')
                    ->orWhere('route_name', 'LIKE', '%' . $this->routeSearch . '%')
                    ->orWhere('method', 'LIKE', '%' . $this->routeSearch . '%');
            });
        }
        $appModuleRoutes->orderBy('position', 'ASC');
        $appModuleRoutes = $appModuleRoutes->select('id', 'title', 'active', 'route_name')->get()->toArray();
        foreach ($appModuleRoutes as $routeKey => $route) {
            $appModuleRoutes[$routeKey]['routeExists'] = Route::has($route['route_name']);
            unset($appModuleRoutes[$routeKey]['route_name']);
        }
        return $this->appModuleRoutes = $appModuleRoutes;
    }

    /**
     * Select a application module route and show more info 
     */
    public function selectAppModuleRoute($uuid)
    {
        if ($this->selectedModuleRoute == $uuid) {
            $this->selectedModuleRoute = NULL;
        } else {
            /**Check if the module exists */
            $appModuleRoute = GetAppModuleRoutesService::byId($uuid);
            $this->selectedModuleRoute = $appModuleRoute->exists() ? $uuid : NULL;
        }
    }

    /**
     *  This will be used for resetting the routeSearch property.
     */
    public function resetModuleRouteSearchInput()
    {
        $this->reset('routeSearch');
    }

    public function updatedAppModuleRoutes($value, $key)
    {
        list($routeKey, $column) = explode('.', $key);
        $editAppModuleRouteService = app(EditAppModuleRouteService::class)->ofId($this->appModuleRoutes[$routeKey]['id']);
        switch ($column) {
            case 'active':
                if ($value == TRUE) $editAppModuleRouteService = $editAppModuleRouteService->activate();
                if ($value == FALSE) $editAppModuleRouteService = $editAppModuleRouteService->deactivate();

                if ($editAppModuleRouteService['success']) {
                    return $this->dispatch('notify', ['message' => 'Successfully changed the module status!', 'type' => 'success']);
                } else {
                    return $this->dispatch('show-exception-modal', $editAppModuleRouteService['error']);
                }
                break;
        }
    }

    public function render()
    {
        $this->getAppModulesRoutes();
        return view('livewire.modules.app-settings.module-routes');
    }
}
