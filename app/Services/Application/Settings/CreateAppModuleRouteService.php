<?php

namespace App\Services\Application\Settings;

use App\Models\Application\AppModuleRoute;

/**
 * Class CreateAppModuleRouteService.php.
 */
class CreateAppModuleRouteService
{
    /** @var string */
    private $title;

    /** @var string */
    private $routeName;

    /** @var string */
    private $method;

    /** @var boolean */
    private $active = FALSE;

    /** @var string */
    private $resourceId = NULL;

    /** @var string */
    private $moduleId = NULL;

    public function __construct(private ?AppModuleRoute $appModuleRoute = NULL)
    {
        // ensure we always have an instance when needed
        $this->appModuleRoute ??= new AppModuleRoute();
    }

    /**
     * Crete a new app module route record
     */
    public function create()
    {
        try {
            $this->appModuleRoute->create($this->getPropertiesAsArray());
            return ['success' => TRUE];
        } catch (\Exception $e) {
            return ['success' => FALSE, 'error' => $e->getMessage()];
        }
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set the value of route_name
     *
     * @return  self
     */
    public function setRouteName($routeName)
    {
        $this->routeName = $routeName;

        return $this;
    }

    /**
     * Set the value of method
     *
     * @return  self
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Set the value of active
     *
     * @return  self
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Set the value of resource_id
     *
     * @return  self
     */
    public function setResourceId($resourceId)
    {
        $this->resourceId = $resourceId;

        return $this;
    }

    /**
     * Set the value of module_id
     *
     * @return  self
     */
    public function setModuleId($moduleId)
    {
        $this->moduleId = $moduleId;

        return $this;
    }

    /**
     * Set the value of position.
     * This will give you the highest nr set +1.
     *
     * @return  int
     */
    public function setPosition()
    {
        $appModuleRoute = AppModuleRoute::where('module_id', $this->moduleId)->get();
        $max =  $appModuleRoute->max('position');
        $count = $appModuleRoute->count();
        return $count === 0 ? 1 : ($max + 1);
    }

    /**
     * Return a array for creating new app module route.
     * 
     * @return array
     */
    private function getPropertiesAsArray()
    {
        return [
            'title'       => $this->title,
            'route_name'  => $this->routeName,
            'method'      => $this->method,
            'active'      => $this->active,
            'resource_id' => $this->resourceId,
            'module_id'   => $this->moduleId,
            'position'    => $this->setPosition(),
        ];
    }
}
