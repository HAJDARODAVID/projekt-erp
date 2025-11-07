<?php

namespace App\Livewire\Modules\Employees\Components;

use App\Livewire\LivewireController;
use App\Services\Employees\ChangeWorkerStatusService;

class DeactivateWorker extends LivewireController
{
    public $rowData;

    /**
     * Call the disable worker service
     * 
     * @return void
     */
    public function disableWorker(): void
    {
        $service = (new ChangeWorkerStatusService($this->rowData))->deactivate();
        $this->closeModal();
        if ($service->getResponse()['success']) {
            $this->refreshTable(WorkersTable::class);
            $this->notifyMe($service->getResponse()['message']);
        } else {
            $this->notifyMe($service->getResponse()['message'], 'danger');
        }
        return;
    }

    public function render()
    {
        return view('livewire.modules.employees.components.deactivate-worker');
    }
}
