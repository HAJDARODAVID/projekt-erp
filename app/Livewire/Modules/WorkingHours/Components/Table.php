<?php

namespace App\Livewire\Modules\WorkingHours\Components;

use App\Livewire\LivewireController;
use App\Services\Attendance\WorkerHoursDataObject;

class Table extends LivewireController
{
    public $tableData;

    public function mount() {}

    public function render()
    {
        return view('livewire.modules.working-hours.components.table', [
            'data' => new WorkerHoursDataObject($this->tableData),
        ]);
    }
}
