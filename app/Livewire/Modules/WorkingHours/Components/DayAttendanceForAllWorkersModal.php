<?php

namespace App\Livewire\Modules\WorkingHours\Components;

use DateTime;
use Livewire\Attributes\On;
use App\Livewire\LivewireController;
use App\Livewire\Modules\WorkingHours\Index as AttendanceReport;
use App\Models\Employees\AttendanceAbsenceType;
use App\Services\Attendance\MassAbsenceAssignmentService;

class DayAttendanceForAllWorkersModal extends LivewireController
{
    public $date;
    public $workers;

    public $absenceType = [];

    #[On('open-day-attendance-for-all-workers-modal')]
    public function initializeModal($date, $workers)
    {
        $this->date = $date;
        $this->workers = $workers;
        $this->setAbsenceTypeProperty();
        $this->openModal();
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
        $this->reset('date', 'workers', 'absenceType');
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

    public function render()
    {
        return view('livewire.modules.working-hours.components.day-attendance-for-all-workers-modal');
    }
}
