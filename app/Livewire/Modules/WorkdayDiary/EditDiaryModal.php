<?php

namespace App\Livewire\Modules\WorkdayDiary;

use Livewire\Component;
use App\Traits\ModalTrait;
use App\Services\Assets\AllCompanyCarsService;
use App\Services\Employees\GroupLeaderService;
use App\Services\ConstructionSite\AllConstructionSitesService;
use App\Services\WorkdayDiary\EditWorkdayDiaryService;
use App\Services\WorkdayDiary\GetWorkdayDiaryService;

class EditDiaryModal extends Component
{
    use ModalTrait;

    /**
     * Initial wdd data from table
     */
    public $row;

    /**
     * WorkdayDiary model
     */
    private $wdd;

    public $diaryInfo = [];
    public $constructionSites = [];
    public $companyCars = [];
    public $groupLeaders = [];

    /**
     * Store all the form errors here
     */
    public $error = [];

    /**
     * Store all the saved from data
     */
    public $save = [];

    public function mount()
    {
        $this->constructionSites = AllConstructionSitesService::getSitesForSelection();
        $this->companyCars = AllCompanyCarsService::getCarsForSelection();
        $this->groupLeaders = GroupLeaderService::getAllForSelect(TRUE);
        /**Set the diary info */
        $this->wdd = (new GetWorkdayDiaryService($this->row->id))->getWorkDayDiary();
        $this->diaryInfo = [
            'workdayType' => $this->wdd->work_type ?? NULL,
            'consId' => $this->wdd->construction_site_id  ?? NULL,
            'gLeaderId' => $this->wdd->user_id ?? NULL,
            'date' => $this->wdd->date ?? NULL,
            'comment' => $this->wdd->work_description ?? NULL,
            'carId' => $this->wdd->car_id ?? NULL,
        ];
    }

    public function updatedDiaryInfo($value, $key)
    {
        $this->error = [];
        $this->save = [];
        $this->wdd = (new GetWorkdayDiaryService($this->row->id))->getWorkDayDiary();
        $service = new EditWorkdayDiaryService($this->row->id);
        switch ($key) {
            case 'workdayType':
                $service->setWorkType($value)->execute();
                break;
            case 'consId':
                if ($value == "init-option") {
                    $this->error['consId'] = TRUE;
                    return $this->diaryInfo['consId'] = $this->wdd->construction_site_id ?? NULL;
                }
                $service->setConstId($value)->execute();
                $this->save['consId'] = TRUE;
                break;
            case 'gLeaderId':
                if ($value == "init-option") {
                    $this->error['gLeaderId'] = TRUE;
                    return $this->diaryInfo['gLeaderId'] = $this->wdd->user_id ?? NULL;
                }
                $service->setUserId($value)->execute();
                $this->save['gLeaderId'] = TRUE;
                break;
            case 'date':
                if ($value == "") {
                    $this->error['date'] = TRUE;
                    return $this->diaryInfo['date'] = $this->wdd->date ?? NULL;
                }
                $service->setDate($value)->execute();
                $this->save['date'] = TRUE;
                break;
            case 'carId':
                if ($value == "") {
                    $this->error['carId'] = TRUE;
                    return $this->diaryInfo['carId'] = $this->wdd->car_id ?? NULL;
                }
                $service->setCarId($value)->execute();
                $this->save['carId'] = TRUE;
                break;
            case 'comment':
                if ($value == "") return $service->setWorkDescToNull();
                $service->setWorkDesc($value)->execute();
                $this->save['comment'] = TRUE;
                break;
        }
    }

    public function beforeCloseModal()
    {
        $this->dispatch('refresh-work-diary-table')->to(WorkDiaryTable::class);
    }

    public function render()
    {
        return view('livewire.modules.workday-diary.edit-diary-modal');
    }
}
