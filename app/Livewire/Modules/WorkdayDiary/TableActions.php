<?php

namespace App\Livewire\Modules\WorkdayDiary;

use Livewire\Component;
use App\Models\WorkingDayRecordModel;
use App\Services\Attendance\GetAttendanceService;

class TableActions extends Component
{
    public $row;

    public function mount($row)
    {
        $this->row = $row;
    }

    public function deleteThisDiary()
    {
        GetAttendanceService::byWdr($this->row->id)->execute();
        //WorkingDayRecordModel::find($this->row->id)->delete();
    }
    public function render()
    {
        return view('livewire.modules.workday-diary.table-actions');
    }
}
