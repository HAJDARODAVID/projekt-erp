<?php

namespace App\Livewire\Modules\AppSettings\Components;

use Livewire\Component;
use App\Traits\ModalTrait;
use App\Traits\ExplodeParams;
use App\Traits\ValidationTrait;
use App\Services\Application\Settings\CreateAppModuleService;
use App\Services\Application\Settings\GetAppModuleService;
use Livewire\Attributes\Url;

class CreateNewAppModuleModal extends Component
{
    use ModalTrait, ExplodeParams, ValidationTrait;

    /**Here we will put the data from the form */
    public $moduleInfo = [];

    /**All the form errors */
    public $error;

    public function createNewAppModule()
    {
        /**Reset the errors on each call */
        $this->reset('error');

        /**Set the validation rules, and check if all good man */
        $validation = $this->addValidationAttributeRules([
            'name' => 'required',
            'module' => 'required',
            'controller' => 'required',
        ])->attributesValidation($this->moduleInfo);

        /**Check here if the controller exists */
        $appModuleCheck = GetAppModuleService::byController($this->moduleInfo['controller'])->getAppModule();
        if ($appModuleCheck != NULL) {
            $this->moduleInfo = [];
            $validation = FALSE;
            $this->closeModal();
            return $this->dispatch('notify', ['message' => 'Given controller is already registered!', 'type' => 'danger']);
        }

        /**If validation returns TRUE then go to service, otherwise set up errors  */
        if ($validation) {
            /**Create new registered module */
            $createAppModuleService = new CreateAppModuleService();
            $createAppModuleService->setName($this->moduleInfo['name'])
                ->setModule($this->moduleInfo['module'])
                ->setController($this->moduleInfo['controller'])
                ->create();
            /**Reset data */
            $this->moduleInfo = [];
            $this->closeModal();
            return $this->dispatch('notify', ['message' => 'A new module has been registered!', 'type' => 'success']);
        } else {
            $this->error = $this->getAllValidationErrors();
        }
    }

    public function render()
    {
        return view('livewire.modules.app-settings.components.create-new-app-module-modal');
    }
}
