<?php

namespace App\Livewire\Modules\AppSettings\Components;

use Livewire\Component;
use App\Services\Application\ModuleStatus;
use App\Services\Application\KebabToPascalCase;
use App\Services\Application\Settings\EditAppModuleService;
use App\Services\Application\Settings\GetAppModuleService;

class ModuleBasicInfoTable extends Component
{
    /**This will be pass thru */
    public $moduleID;

    /**All the module info/data */
    public $moduleData;

    public $controllerExists = FALSE;
    public $moduleExists = FALSE;

    public function mount()
    {
        $this->getModuleInfo();
    }

    public function updatedModuleData($value, $key)
    {
        if ($value == "") $value = NULL;
        $editAppModuleService = app(EditAppModuleService::class);
        $editAppModuleService->ofId($this->moduleID)->setNewValue([$key => $value]);
        $editAppModuleService = $editAppModuleService->save();
        if ($editAppModuleService['success']) {
            return $this->dispatch('notify', ['message' => 'Successfully saved!', 'type' => 'success']);
        } else {
            return $this->dispatch('show-exception-modal', $editAppModuleService['error']);
        }
    }

    /**
     * Get all the module info needed
     * 
     * @return void
     */
    private function getModuleInfo(): void
    {
        $this->moduleData = GetAppModuleService::byId($this->moduleID)->getAppModuleArray();
        if (!empty($this->moduleData)) {
            $this->moduleData['status'] = ModuleStatus::setByStatus($this->moduleData['active'])->getModuleStatusDesc();
            $this->controllerExists = class_exists("App\\Http\\Controllers\\" . $this->moduleData['controller']);
            $this->moduleExists = is_dir("..\\App\\Livewire\\Modules\\" . KebabToPascalCase::convert($this->moduleData['module']));
        }
    }

    public function render()
    {
        $this->getModuleInfo();
        return view('livewire.modules.app-settings.components.module-basic-info-table');
    }
}
