<?php

namespace App\Livewire\Modules\WorkdayDiary;

use Livewire\Component;
use App\Traits\ModalTrait;
use App\Models\WorkingDayRecordModel;
use App\Services\Attendance\GetAttendanceService;
use App\Services\WorkdayDiary\DeleteWorkdayDiaryService;

class TableActions extends Component
{
    use ModalTrait;

    public $row;

    public function mount($row)
    {
        $this->row = $row;
    }

    public function deleteThisDiaryAction($attendanceFlag)
    {
        $attendanceFlag = $attendanceFlag == 'true' ? TRUE : FALSE;
        $service = new DeleteWorkdayDiaryService($this->row->id);
        $service = $service->execute($attendanceFlag);
        //dd($attendanceFlag);
        //GetAttendanceService::byWdr($this->row->id)->execute();
        //WorkingDayRecordModel::find($this->row->id)->delete();
    }

    public function render()
    {
        return view('livewire.modules.workday-diary.table-actions');
    }
}
