<?php

namespace App\Services\Application\Settings;

use App\Models\Application\AppModule;
use App\Services\Application\ModuleStatus;

/**
 * Class EditAppModuleService.
 */
class EditAppModuleService
{
    /**
     * Store the app module model 
     * 
     * @var AppModule
     */
    private $appModule;

    public function __construct(AppModule $appModule)
    {
        $this->appModule = $appModule;
    }

    /**
     * Set the model from the app module ID
     * 
     * @return EditAppModuleService
     */
    public function ofId($id)
    {
        $this->appModule = $this->appModule->find($id);
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
            $this->appModule->$key = $value;
        }
        return $this;
    }

    /**
     * Activate the app module
     * 
     * @return EditAppModuleService|array
     */
    public function activate($saveImmediately = TRUE)
    {
        $this->appModule->active = ModuleStatus::MODULE_STATUS_ACTIVE;
        if ($saveImmediately) return $this->save();
        return $this;
    }

    /**
     * Deactivate the app module
     * 
     * @return EditAppModuleService|array
     */
    public function deactivate($saveImmediately = TRUE)
    {
        $this->appModule->active = ModuleStatus::MODULE_STATUS_DISABLED;
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
            $this->appModule->save();
            return ['success' => TRUE];
        } catch (\Exception $e) {
            return ['success' => FALSE, 'error' => $e->getMessage()];
        }
    }
}
