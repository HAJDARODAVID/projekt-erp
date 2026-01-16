<?php

namespace App\Livewire\Modules\Employees\Components;

use App\Livewire\LivewireController;
use App\Models\Employees\Worker;
use App\Models\Employees\Workplace;
use App\Services\Employees\GetWorkerInfo;

class BasicWorkerInfo extends LivewireController
{
    public $workerId;

    /**
     * Store worker info.
     *
     * @var array  
     */
    public $workerInfo;

    /**
     * Store all the active workplaces.
     *
     * @var array  
     */
    public $workplaces;

    public function mount()
    {
        $this->getWorkerInfo();
        $this->workplaces = Workplace::where('status', TRUE)->pluck('name', 'id')->toArray();
    }

    /**
     * Get all the worker info
     * 
     * @return void
     */
    private function getWorkerInfo(): void
    {
        $this->workerInfo = (new GetWorkerInfo($this->workerId))->toArray();
    }

    public function render()
    {
        return view('livewire.modules.employees.components.basic-worker-info');
    }
}
