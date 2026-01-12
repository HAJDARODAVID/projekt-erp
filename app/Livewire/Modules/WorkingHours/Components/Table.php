<?php

namespace App\Livewire\Modules\WorkingHours\Components;

use App\Livewire\LivewireController;
use App\Services\Attendance\WorkerHoursDataObject;

class Table extends LivewireController
{
    public $tableData;

    public function openDayAttendanceModal(string $param = "")
    {
        dd('im in', date('Y-m-d', $param), (new WorkerHoursDataObject($this->tableData))->getWorkers());
    }

    public function render()
    {
        return view('livewire.modules.working-hours.components.table', [
            'data' => new WorkerHoursDataObject($this->tableData),
        ]);
    }
}
