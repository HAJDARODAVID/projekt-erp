<?php

namespace App\Livewire\Modules\WorkingHours\Components;

use App\Livewire\LivewireController;
use App\Services\Attendance\GetAttendanceService;
use App\Services\WorkdayDiary\GetAllWorkDiariesForDateService;
use App\Services\WorkdayDiary\Transformers\WorkDiariesToSelectTransformer;
use Livewire\Attributes\On;

class EditWorkDiaryOnAttendanceModal extends LivewireController
{
    public $icon = NULL;
    public $displayIcon = TRUE;

    public $attendance = NULL;
    public $allWorkDiariesOptions = [];

    #[On('open-edit-work-diary-on-attendance-modal')]
    public function init($attID)
    {
        $this->getAttendance($attID)->getAvailableDiaries()->openModal();
    }

    /**
     * Get the attendance model based on the given ID
     * 
     * @param int $attID Attendance ID
     * @return EditWorkDiaryOnAttendanceModal
     */
    private function getAttendance(int $attID): self
    {
        try {
            $this->attendance = GetAttendanceService::byId($attID)->getMyWorkerAttendance();
        } catch (\Throwable $th) {
            $this->showException($th->getMessage());
        }
        return $this;
    }

    /**
     * Get and set all data regarding the work diaries.
     * This will set the selected property, and the available.
     * 
     * @return EditWorkDiaryOnAttendanceModal
     */
    private function getAvailableDiaries(): self
    {
        /**First check if the attendance is set, and if not send a notify and return */
        if ($this->attendance == \NULL) {
            $this->blockModelOpening()->notifyMe(translator('No attendance found for the given ID!'), 'danger');
            return $this;
        }
        /**set the work diaries */
        try {
            $getAllWorkDiariesForDateService = (new GetAllWorkDiariesForDateService(new \DateTime($this->attendance->date)))->with('constructionSite', 'user')->execute();
            $workDiariesToSelectTransformer = new WorkDiariesToSelectTransformer($getAllWorkDiariesForDateService->getWorkDayDiaries());
            $this->allWorkDiariesOptions = $workDiariesToSelectTransformer->setSelectOptionsKeyPair('id', 'constructionSite.name& - &user.name')->withNullOption()->getSelectOptions();
        } catch (\Throwable $th) {
            $this->showException($th->getMessage());
        }
        return $this;
    }

    public function render()
    {
        return view('livewire.modules.working-hours.components.edit-work-diary-on-attendance-modal');
    }
}
