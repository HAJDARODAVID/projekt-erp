<?php

namespace App\Services\Application\Settings;

use App\Models\Application\AppModule;

/**
 * Class GetAppModuleService.
 */
class GetAppModuleService
{
    /** @var AppModule*/
    private $appModule;

    private function __construct($from, $value)
    {
        $this->appModule = AppModule::where($from, $value)->first();
    }

    /**
     * Get the app module model by id
     * 
     * @return self
     */
    public static function byId($id)
    {
        return new self('id', $id);
    }

    /**
     * Get the app module model by name
     * 
     * @return self
     */
    public static function byName($name)
    {
        return new self('name', $name);
    }

    /**
     * Get the app module model by module
     * 
     * @return self
     */
    public static function byModule($module)
    {
        return new self('module', $module);
    }

    /**
     * Get the app module model by controller
     * 
     * @return self
     */
    public static function byController($controller)
    {
        return new self('controller', $controller);
    }

    /**
     * Get the model 
     * 
     * @return AppModule
     */
    public function getAppModule()
    {
        return $this->appModule;
    }

    /**
     * Get the array from the model 
     * 
     * @return array
     */
    public function getAppModuleArray()
    {
        return $this->appModule != NULL ? $this->appModule->toArray() : [];
    }

    /**
     * Get if the module exists 
     * 
     * @return boolean
     */
    public function exists()
    {
        return $this->appModule != NULL ? TRUE : FALSE;
    }
}
