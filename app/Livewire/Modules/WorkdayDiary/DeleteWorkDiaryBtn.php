<?php

namespace App\Livewire\Modules\WorkdayDiary;

use Livewire\Component;
use App\Traits\ModalTrait;
use App\Services\WorkdayDiary\DeleteWorkdayDiaryService;

class DeleteWorkDiaryBtn extends Component
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

        if ($service['success']) {
            $this->dispatch('refresh-work-diary-table')->to(WorkDiaryTable::class);
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.modules.workday-diary.delete-work-diary-btn');
    }
}
