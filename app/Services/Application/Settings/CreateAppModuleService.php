<?php

namespace App\Services\Application\Settings;

use App\Models\Application\AppModule;

/**
 * Class CreateAppModuleService.
 */
class CreateAppModuleService
{
    /** @var string */
    private $name;

    /** @var string */
    private $module;

    /** @var string */
    private $controller;

    /** @var boolean */
    private $active = FALSE;

    public function create()
    {
        return AppModule::create($this->getPropertiesAsArray());
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the value of module
     *
     * @return  self
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Set the value of controller
     *
     * @return  self
     */
    public function setController($controller)
    {
        $this->controller = $controller;

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
     * Return a array for creating new app module.
     * 
     * @return array
     */
    private function getPropertiesAsArray()
    {
        return [
            'name'       => $this->name,
            'module'     => $this->module,
            'controller' => $this->controller,
            'active'     => $this->active,
        ];
    }
}
