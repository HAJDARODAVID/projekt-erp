<?php

namespace App\Livewire\Modules\WorkdayDiary;

use Livewire\Component;
use App\Traits\ModalTrait;
use App\Traits\ExplodeParams;
use App\Traits\ValidationTrait;
use App\Services\WorkdayDiary\Types;
use App\Services\Employees\WorkersService;
use App\Services\Assets\AllCompanyCarsService;
use App\Services\Employees\GroupLeaderService;
use App\Services\ConstructionSite\AllConstructionSitesService;
use App\Services\WorkdayDiary\CreateNewWorkdayDiaryService;

class CreateNewDiaryModal extends Component
{
    use ModalTrait, ExplodeParams, ValidationTrait;

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
        ])->attributesValidation($this->diaryInfo);

        /**If validation returns TRUE then go to service, otherwise set up errors  */
        if ($validation) {
            $service = new CreateNewWorkdayDiaryService();
            $service->setUser($this->diaryInfo['gLeaderId'] ?? NULL)
                ->setJobSiteId($this->diaryInfo['consId'] ?? NULL)
                ->setCarId($this->diaryInfo['carId'] ?? NULL)
                ->setDate($this->diaryInfo['date'] ?? NULL)
                ->setWorkType($this->diaryInfo['workdayType'] ?? NULL)
                ->setLog($this->diaryInfo['comment'] ?? NULL);
            $service = $service->execute();
            if ($service['success']) {
                return redirect()->route('hp_showWorkDayDiary', [$service['newDiary']->id]);
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

    /**
     *  This will be used for resetting the workerSearch property.
     */
    public function resetSearchInput()
    {
        return $this->reset('workerSearch');
    }

    public function render()
    {
        return view('livewire.modules.workday-diary.create-new-diary-modal');
    }
}
