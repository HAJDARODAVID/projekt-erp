<?php

namespace App\Livewire\Modules\WorkdayDiary;

use Livewire\Component;
use App\Traits\ModalTrait;
use App\Models\WorkingDayLogModel;
use App\Services\WorkdayDiary\Types;
use App\Services\Assets\AllCompanyCarsService;
use App\Services\ConstructionSite\AllConstructionSitesService;
use App\Services\Employees\GroupLeaderService;

class CreateNewDiaryModal extends Component
{
    use ModalTrait;

    public $searchWorkerInput;

    public $diaryInfo = [];
    public $attendance = 'test';

    public $constructionSites = [];
    public $companyCars = [];
    public $groupLeaders = [];

    public function beforeOpenModal()
    {
        $this->diaryInfo['workdayType'] = Types::home();
        $this->constructionSites = AllConstructionSitesService::getSitesForSelection();
        $this->companyCars = AllCompanyCarsService::getCarsForSelection();
        $this->groupLeaders = GroupLeaderService::getAllForSelect();
    }

    public function updatedSearchWorkerInput($value) {}

    public function createNewDiary()
    {
        dd($this);
    }

    public function render()
    {
        return view('livewire.modules.workday-diary.create-new-diary-modal');
    }
}
