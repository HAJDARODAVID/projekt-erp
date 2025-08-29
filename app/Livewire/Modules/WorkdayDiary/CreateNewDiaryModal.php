<?php

namespace App\Livewire\Modules\WorkdayDiary;

use Livewire\Component;
use App\Traits\ModalTrait;
use App\Traits\ExplodeParams;
use App\Traits\ValidationTrait;
use App\Services\WorkdayDiary\Types;
use App\Services\Employees\WorkersService;
use App\Services\Assets\AllCompanyCarsService;
use App\Services\Attendance\CreateAttendanceService;
use App\Services\Employees\GroupLeaderService;
use App\Services\ConstructionSite\AllConstructionSitesService;
use App\Services\WorkdayDiary\CreateNewWorkdayDiaryService;

class CreateNewDiaryModal extends Component
{
    use ModalTrait, ExplodeParams, ValidationTrait;

    const ATTENDANCE_TYPES = ['myWorkers', 'cooperators'];

    public $searchWorkerInput;

    public $diaryInfo = [];
    public $attendance;

    public $constructionSites = [];
    public $companyCars = [];
    public $groupLeaders = [];

    public $workerSearch = NULL;
    public $workers;

    public $error;

    public function beforeOpenModal()
    {
        $this->diaryInfo['workdayType'] = Types::home();
        $this->constructionSites = AllConstructionSitesService::getSitesForSelection();
        $this->companyCars = AllCompanyCarsService::getCarsForSelection();
        $this->groupLeaders = GroupLeaderService::getAllForSelect();
    }

    public function createNewDiary()
    {
        /**Reset the errors on each call */
        $this->reset('error');

        /**Set the validation rules, and check if all good man */
        $validation = $this->addValidationAttributeRules([
            'date' => 'required',
            'consId' => 'required',
        ])->attributesValidation($this->diaryInfo);

        /**If validation returns TRUE then go to service, otherwise set up errors  */
        if ($validation) {
            /**Create a new diary */
            $createNewWorkdayDiaryService = new CreateNewWorkdayDiaryService();
            $createNewWorkdayDiaryService->setUser($this->diaryInfo['gLeaderId'] ?? NULL)
                ->setJobSiteId($this->diaryInfo['consId'] ?? NULL)
                ->setCarId($this->diaryInfo['carId'] ?? NULL)
                ->setDate($this->diaryInfo['date'] ?? NULL)
                ->setWorkType($this->diaryInfo['workdayType'] ?? NULL)
                ->setLog($this->diaryInfo['comment'] ?? NULL);
            $createNewWorkdayDiaryService = $createNewWorkdayDiaryService->execute();

            if ($createNewWorkdayDiaryService['success']) {
                /**If we created a new diary check if we have workers in attendance */
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
                                if ($data['attTime']) {
                                    $createAttendanceService->setWorkerID($workerId)
                                        ->setDiaryID($createNewWorkdayDiaryService['newDiary']->id)
                                        ->setType($this->diaryInfo['workdayType'])
                                        ->setWorkHours($data['attTime'])
                                        ->setDate($this->diaryInfo['date']);
                                    $createAttendanceService->execute();
                                }
                            }
                        }
                    }
                }

                //return redirect()->route('hp_showWorkDayDiary', [$createNewWorkdayDiaryService['newDiary']->id]);
                $this->resetData();
                $this->closeModal();
                $this->dispatch('refresh-work-diary-table')->to(WorkDiaryTable::class);
                return $this->dispatch('notify', ['message' => 'Kreiran novi dnevnik radova!', 'type' => 'success']);
            }
        } else {
            $this->error = $this->getAllValidationErrors();
        }
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
        return $this->workers = WorkersService::myWorkers()->cooperators()->active()->search($value);
    }

    /**
     * Add the worker to the attendance array.
     */
    public function addWorkerToAttendance($params)
    {
        extract($this->explodeParams($params, ['id', 'name', 'for']));
        if (!isset($this->attendance[$for][$id])) {
            $this->attendance[$for][$id] = [
                'name' => $name,
                'attTime' => NULL,
            ];
        }
        $this->reset('workerSearch', 'workers');
    }

    /**
     * Remove the worker to the attendance array.
     */
    public function removeWorkerFromAttendance($params)
    {
        extract($this->explodeParams($params, ['id', 'for']));
        unset($this->attendance[$for][$id]);
    }

    public function updatedDiaryInfo($value, $key)
    {
        if ($key == 'carId') {
            if ($value == 'init-option') unset($this->diaryInfo['carId']);
        }
    }

    /**
     *  This will be used for resetting the workerSearch property.
     */
    public function resetSearchInput()
    {
        return $this->reset('workerSearch');
    }

    /**
     * This will reset all the workday diary data
     */
    private function resetData()
    {
        $this->diaryInfo = [];
        $this->diaryInfo['workdayType'] = Types::home();
        $this->attendance = NULL;
    }

    public function render()
    {
        return view('livewire.modules.workday-diary.create-new-diary-modal');
    }
}
