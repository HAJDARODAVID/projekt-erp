<?php

namespace App\Livewire\Modules\WorkingHours\Components;

use App\Exceptions\ErrorMessage;
use App\Livewire\LivewireController;
use App\Models\Employees\Worker;
use App\Services\Attendance\DeleteAttendanceService;
use App\Services\Attendance\GetWorkerMonthlyAttendanceService;
use App\Services\Months;
use App\Services\Years;
use Livewire\Attributes\Url;
use App\Services\WorkdayDiary\Types as AttendanceType;

class MonthlyOverviewCard extends LivewireController
{
    public $months = [];
    public $years = [];

    #[Url('month')]
    public $selectedMonth = NULL;

    #[Url('year')]
    public $selectedYear = NULL;

    /** Gives the component the worker ID for the data */
    public $workerID = NULL;

    /** Store the attendance data here */
    public $attendance = [];

    /**Attendance type for select */
    public $attTypes = [0 => ''];

    public function mount()
    {
        $this->attTypes = array_merge($this->attTypes, AttendanceType::getTypes());
        $this->months = Months::MONTHS_HR;
        $this->selectedMonth =  $this->selectedMonth == NULL ? date('n') :  $this->selectedMonth;

        $this->years = Years::getYearsList();
        $this->selectedYear =  $this->selectedYear == NULL ? date('Y') :  $this->selectedYear;

        if ($this->workerID) $this->getAttendanceDataAction();
    }

    /**
     * Run and fined if the year/month have been changed
     */
    public function updated($key)
    {
        if ($key == 'selectedMonth' || $key == 'selectedYear') $this->getAttendanceDataAction();
    }

    /**
     * This will call the service to get the data.
     * Throw error message if there is one.
     * 
     * @return MonthlyOverviewCard
     */
    private function getAttendanceDataAction()
    {
        try {
            $service = (new GetWorkerMonthlyAttendanceService(
                Worker::find($this->workerID),
                $this->selectedMonth,
                $this->selectedYear
            ))->execute();
            $response = $service->getResponse();
            if ($response['success']) {
                $this->attendance = $response['data'];
            } else {
                throw new ErrorMessage($response['message']);
            }
        } catch (\Throwable $th) {
            $this->showException($th->getMessage());
        }
        return $this;
    }

    /**
     * Delete attendance action
     * 
     * @return void
     */
    public function deleteAttendanceAction($id): void
    {
        try {
            $service = (DeleteAttendanceService::byID($id))->execute();
            $response = $service->getResponse();
            if ($response['success']) {
                $this->getAttendanceDataAction();
                $this->notifyMe($response['message']);
            } else {
                throw new ErrorMessage($response['message']);
            }
        } catch (\Throwable $th) {
            $this->showException($th->getMessage());
        }
        return;
    }

    public function render()
    {
        return view('livewire.modules.working-hours.components.monthly-overview-card');
    }
}
