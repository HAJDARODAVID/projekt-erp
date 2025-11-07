<?php

namespace App\Livewire\Modules\Employees\Components;

use App\Livewire\LivewireController;
use App\Models\User\UserType;
use App\Services\Employees\HasWorkerAppUserService;

class CreateAppUserFromWorker extends LivewireController
{
    public $rowData;

    /**
     * Use to disable btn if worker has a app user
     * 
     * @var bool
     */
    public $disabled;

    /**All the form errors */
    public $error;

    /**Store the email from form */
    public $email;

    /**Assignable user types */
    public $userTypeOptions;

    /**User type selected */
    public $userType;

    public function mount()
    {
        $userService = new HasWorkerAppUserService($this->rowData);
        $this->disabled = $userService->hasUser();

        $this->userType = UserType::DEFAULT;
        $this->setUserTypes();
    }

    /**
     * Call on click to create a new user for the worker
     * 
     * @return void
     */
    public function createUser()
    {
        /**Reset the errors on each call */
        $this->reset('error');

        /**Set the validation rules, and check if all good */
        $validation = $this->addValidationAttributeRules([
            'email' => 'required|email',
        ])->attributesValidation(['email' => $this->email]);

        /**If validation returns TRUE then go to service, otherwise set up errors  */
        if ($validation) {
        } else {
            $this->error = $this->getAllValidationErrors();
        }
    }

    protected function beforeCloseModal()
    {
        $this->reset('error', 'email');
    }

    /**
     * Set up the options for the user types
     * 
     * @return void
     */
    private function setUserTypes(): void
    {
        //TODO: put the lang from session
        $options = UserType::init()->getAssignableTypes('hr');
        foreach ($options as $key => $type) {
            $options[$key] = $key . ' - ' . $type;
        }
        $this->userTypeOptions = $options;
    }

    public function render()
    {
        return view('livewire.modules.employees.components.create-app-user-from-worker');
    }
}
