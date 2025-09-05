<?php

namespace App\Livewire\Modules\WorkdayDiary;

use Livewire\Component;
use App\Traits\ModalTrait;
use App\Traits\ExplodeParams;
use App\Services\Employees\WorkersService;
use App\Services\Attendance\GetAttendanceService;
use App\Services\Attendance\CreateAttendanceService;
use App\Services\Attendance\RemoveAttendanceService;

class EditAttendanceModal extends Component
{
    use ModalTrait, ExplodeParams;

    const ATTENDANCE_TYPES = ['myWorkers', 'cooperators'];

    /**
     * Initial wdd data from table
     */
    public $row;

    /**
     * All the worker attendance
     */
    public $attendance;

    public $workerSearch = NULL;
    public $workers;

    public function mount() {}

    /**
     * This will be run before the modal is open
     */
    public function beforeOpenModal()
    {
        $this->setAttendanceFromTable();
    }

    /**
     * This method is triggered on the change event on the property $workerSearch.
     * The result will be stored in the $workers property
     */
    public function updatedWorkerSearch($value)
    {
        if ($value == "") {
            return $this->workers = NULL;
        }
        return $this->workers = WorkersService::myWorkers(TRUE)->cooperators()->active()->search($value);
    }

    /**
     * Add the worker to the attendance array.
     */
    public function addWorkerToAttendance($params)
    {
        extract($this->explodeParams($params, ['id', 'name', 'for']));
        if (!isset($this->attendance[$for][$id])) {
            $this->attendance[$for][$id] = [
                'att_id' => NULL,
                'name' => $name,
                'att_time' => NULL,
            ];
        }
        $this->reset('workerSearch', 'workers');
    }


    /**
     *  This will be used for resetting the workerSearch property.
     */
    public function resetSearchInput()
    {
        return $this->reset('workerSearch');
    }

    /**
     * Remove the worker to the attendance array.
     */
    public function removeWorkerFromAttendance($params)
    {
        extract($this->explodeParams($params, ['id', 'for']));
        if ($this->attendance[$for][$id]['att_id']) {
            $attService = RemoveAttendanceService::myWorker($this->attendance[$for][$id]['att_id']);
            $attService->execute();
        }
        unset($this->attendance[$for][$id]);
    }

    private function setAttendanceFromTable()
    {
        $service = GetAttendanceService::byWdr($this->row->id)->createDataForEditAttendanceComponent();
        $this->attendance['myWorkers'] = $service->getMyWorkerAttendance();
        $this->attendance['cooperators'] = $service->getCooperatorAttendance();
    }

    public function saveAttendance()
    {
        foreach (self::ATTENDANCE_TYPES as $type) {
            /**Set the right object */
            $createAttendanceService = NULL;
            switch ($type) {
                case 'myWorkers':
                    $createAttendanceService = CreateAttendanceService::myWorker();
                    break;
                case 'cooperators':
                    $createAttendanceService = CreateAttendanceService::cooperator();
                    break;
            }
            /**Check if the attendance data is set correctly */
            if (isset($this->attendance[$type])) {
                if (is_array($this->attendance[$type])) {
                    foreach ($this->attendance[$type] as $workerId => $data) {
                        if ($data['att_time']) {
                            if ($data['att_id'] == NULL) {
                                $createAttendanceService->setWorkerID($workerId)
                                    ->setDiaryID($this->row->id)
                                    ->setType($this->row['workdayType'])
                                    ->setWorkHours($data['att_time'])
                                    ->setDate($this->row['date']);
                                $createAttendanceService->execute();
                            }
                        }
                    }
                }
            }
        }
        $this->closeModal();
        $this->dispatch('refresh-work-diary-table')->to(WorkDiaryTable::class);
        return $this->dispatch('notify', ['message' => 'Prisustvo pohranjeno!', 'type' => 'success']);
    }

    public function render()
    {
        return view('livewire.modules.workday-diary.edit-attendance-modal');
    }
}
