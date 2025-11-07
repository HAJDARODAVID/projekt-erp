<?php

namespace App\Services\Application\Settings;

use App\Models\Application\AppModuleRoute;

class GetAppModuleRoutesService
{
    /** @var AppModuleRoute*/
    private $appModuleRoutes;

    private function __construct($from, $value)
    {
        $this->appModuleRoutes = AppModuleRoute::where($from, $value)->first();
    }

    /**
     * Get the app module route model by id
     * 
     * @return self
     */
    public static function byId($id)
    {
        return new self('id', $id);
    }

    /**
     * Get the app module route model by title
     * 
     * @return self
     */
    public static function byTitle($title)
    {
        return new self('title', $title);
    }

    /**
     * Get the app module model by route name
     * 
     * @return self
     */
    public static function byRouteName($routeName)
    {
        return new self('route_name', $routeName);
    }

    /**
     * Get the app module model by method
     * 
     * @return self
     */
    public static function byMethod($method)
    {
        return new self('method', $method);
    }

    /**
     * Get the app module model by module ID
     * 
     * @return self
     */
    public static function byModuleId($moduleId)
    {
        return new self('module_id', $moduleId);
    }

    /**
     * Get the model 
     * 
     * @return AppModuleRoute
     */
    public function getAppModuleRoutesModel()
    {
        return $this->appModuleRoutes;
    }

    /**
     * Get the array from the model 
     * 
     * @return array
     */
    public function getAppModuleRouteArray()
    {
        return $this->appModuleRoutes != NULL ? $this->appModuleRoutes->toArray() : [];
    }

    /**
     * Get if the module exists 
     * 
     * @return boolean
     */
    public function exists()
    {
        return $this->appModuleRoutes != NULL ? TRUE : FALSE;
    }
}
