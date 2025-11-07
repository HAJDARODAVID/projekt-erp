<?php

namespace App\Livewire\Modules\AppSettings\Components;

use App\Livewire\LivewireController;
use App\Services\Application\Settings\CreateAppModuleRouteService;

class CreateNewModuleRouteModal extends LivewireController
{
    /**This will hold the module/controller ID */
    public $moduleID = [];

    /**Here we will put the data from the form */
    public $routeInfo = [];

    /**All the form errors */
    public $error;

    public function createNewAppModuleRoute()
    {
        /**Reset the errors on each call */
        $this->reset('error');

        /**Set the validation rules, and check if all good man */
        $validation = $this->addValidationAttributeRules([
            'title' => 'required',
            'route_name' => 'required',
            'method' => 'required',
        ])->attributesValidation($this->routeInfo);

        /**If validation returns TRUE then go to service, otherwise set up errors  */
        if ($validation) {
            /**Create new registered module */
            $createAppModuleService = new CreateAppModuleRouteService();
            $createAppModuleService->setTitle($this->routeInfo['title'])
                ->setRouteName($this->routeInfo['route_name'])
                ->setMethod($this->routeInfo['method'])
                ->setModuleId($this->moduleID);
            $createService = $createAppModuleService->create();
            if ($createService['success']) {
                /**Reset data */
                $this->routeInfo = [];
                $this->closeModal();
                return $this->notifyMe('A new module route has been registered!');
            } else {
                return $this->showException($createService['error']);
            }
        } else {
            $this->error = $this->getAllValidationErrors();
        }
    }

    public function render()
    {
        return view('livewire.modules.app-settings.components.create-new-module-route-modal');
    }
}
