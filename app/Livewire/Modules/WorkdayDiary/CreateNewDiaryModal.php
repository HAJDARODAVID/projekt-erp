<?php

namespace App\Livewire\Modules\WorkdayDiary;

use Livewire\Component;
use App\Traits\ModalTrait;
use App\Models\WorkingDayLogModel;
use App\Services\WorkdayDiary\Types;
use App\Services\Assets\AllCompanyCarsService;
use App\Services\ConstructionSite\AllConstructionSitesService;

class CreateNewDiaryModal extends Component
{
    use ModalTrait;

    public $diaryInfo = [];

    public $constructionSites = [];
    public $companyCars = [];

    public function beforeOpenModal()
    {
        $this->diaryInfo['workdayType'] = Types::home();
        $this->constructionSites = AllConstructionSitesService::getSitesForSelection();
        $this->companyCars = AllCompanyCarsService::getCarsForSelection();
    }

    public function createNewDiary()
    {
        dd($this);
    }

    public function render()
    {
        return view('livewire.modules.workday-diary.create-new-diary-modal');
    }
}
