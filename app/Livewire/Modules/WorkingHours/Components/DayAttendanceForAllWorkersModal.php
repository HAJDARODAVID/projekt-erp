<?php

namespace App\Livewire\Modules\WorkingHours\Components;

use DateTime;
use Livewire\Attributes\On;
use App\Livewire\LivewireController;
use App\Models\Employees\AttendanceAbsenceType;
use App\Services\Attendance\GetAttendanceService;
use App\Services\Attendance\DeleteAttendanceService;
use App\Services\Attendance\MassAbsenceAssignmentService;
use App\Livewire\Modules\WorkingHours\Index as AttendanceReport;

class DayAttendanceForAllWorkersModal extends LivewireController
{
    public $date;
    public $workers;

    public $absenceType = [];

    public $showDeleteAtt = FALSE;

    #[On('open-day-attendance-for-all-workers-modal')]
    public function initializeModal($date, $workers)
    {
        try {
            $this->date = $date;
            $this->workers = $workers;
            $this->setAbsenceTypeProperty();
            $this->showDeleteAtt = GetAttendanceService::byDate((new DateTime())->setTimestamp($this->date))->myEmployees()->countAtt() > 0 ? TRUE : FALSE;
            $this->openModal();
        } catch (\Throwable $th) {
            return $this->dispatch('show-exception-modal', $th->getMessage());
        }
    }

    /**
     * Set all the data needed for displaying absence types.
     * 
     * @return void
     */
    private function setAbsenceTypeProperty(): void
    {
        $output = [];
        foreach (AttendanceAbsenceType::init()->getMassAssignable() as $type) {
            $type = AttendanceAbsenceType::setByType($type);
            $output[$type->code()] = [
                'description' => $type->description(),
                'short-text' => $type->shortDesc(),
            ];
        }
        $this->absenceType = $output;
    }

    /**
     * Reset the properties before closing the modal
     * 
     * @return void
     */
    public function beforeCloseModal(): void
    {
        $this->reset('date', 'workers', 'absenceType', 'showDeleteAtt');
    }

    /**
     * Btn click action that will run the MassAbsenceAssignment service.
     * When used, this will add a absence type to all workers in the report.
     * 
     * @param $typeCode Provided by the btn, defines the type code for the absence.
     */
    public function applyAbsenceAction($typeCode)
    {
        $service = NULL;
        try {
            $dateTimeObject = (new DateTime())->setTimestamp($this->date);
            $service = (new MassAbsenceAssignmentService)
                ->execute(
                    $dateTimeObject,
                    /**TODO: create some kind of DTO for workers */
                    $this->workers,
                    AttendanceAbsenceType::setByType($typeCode)
                )
                ->getResponse();
        } catch (\Throwable $th) {
            return $this->dispatch('show-exception-modal', $th->getMessage());
        }

        $this->closeModal();
        $this->dispatch('refresh-attendance-report')->to(AttendanceReport::class);
        return $service['message'] != NULL ? $this->notifyMe($service['message'], $service['success'] ? 'success' : 'danger') : NULL;
    }

    /**
     * Btn click action that will run the DeleteAttendanceService service.
     * This will delete all the attendance for this day.
     */
    public function deleteAllAttendanceAction()
    {
        $service = NULL;
        try {
            $service = new DeleteAttendanceService(GetAttendanceService::byDate((new DateTime())->setTimestamp($this->date))->myEmployees()->getAtt());
            $service = $service->execute()->getResponse();
        } catch (\Throwable $th) {
            return $this->dispatch('show-exception-modal', $th->getMessage());
        }

        $this->closeModal();
        $this->dispatch('refresh-attendance-report')->to(AttendanceReport::class);
        return $service['message'] != NULL ? $this->notifyMe($service['message'], $service['success'] ? 'success' : 'danger') : NULL;
    }

    public function render()
    {
        return view('livewire.modules.working-hours.components.day-attendance-for-all-workers-modal');
    }
}
