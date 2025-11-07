<?php

namespace App\Services\Application\Settings;

use App\Models\Application\AppModule;
use App\Models\Application\AppModuleRoute;
use App\Services\Application\ModuleStatus;

/**
 * Class EditAppModuleRouteService.
 */
class EditAppModuleRouteService
{
    /**
     * Store the app module route model 
     * 
     * @var AppModuleRoute
     */
    private $appModuleRoute;

    public function __construct(AppModuleRoute $appModuleRoute)
    {
        $this->appModuleRoute = $appModuleRoute;
    }

    /**
     * Set the model from the app module route ID
     * 
     * @return EditAppModuleRouteService
     */
    public function ofId($id)
    {
        $this->appModuleRoute = $this->appModuleRoute->find($id);
        return $this;
    }

    /**
     * Set the new value in the given column.
     * 
     * @param array $array Key/value pairs where the key is the column and the value is the value
     */
    public function setNewValue(array $array)
    {
        foreach ($array as $key => $value) {
            $this->appModuleRoute->$key = $value;
        }
        return $this;
    }

    /**
     * Activate the app module route
     * 
     * @return EditAppModuleRouteService|array
     */
    public function activate($saveImmediately = TRUE)
    {
        $this->appModuleRoute->active = ModuleStatus::MODULE_STATUS_ACTIVE;
        if ($saveImmediately) return $this->save();
        return $this;
    }

    /**
     * Deactivate the app module route
     * 
     * @return EditAppModuleRouteService|array
     */
    public function deactivate($saveImmediately = TRUE)
    {
        $this->appModuleRoute->active = ModuleStatus::MODULE_STATUS_DISABLED;
        if ($saveImmediately) return $this->save();
        return $this;
    }

    /**
     * Save the changes on the model.
     * 
     * @return array
     */
    public function save()
    {
        try {
            $this->appModuleRoute->save();
            return ['success' => TRUE];
        } catch (\Exception $e) {
            return ['success' => FALSE, 'error' => $e->getMessage()];
        }
    }
}
