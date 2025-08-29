<?php

namespace App\Livewire\Modules\WorkdayDiary;

use Livewire\Component;
use App\Traits\ModalTrait;
use App\Livewire\Modules\WorkdayDiary\WorkDiaryTable;
use App\Services\WorkdayDiary\DeleteWorkdayDiaryService;

class TableActions extends Component
{
    use ModalTrait;

    public $row;

    public function mount($row)
    {
        $this->row = $row;
    }

    public function render()
    {
        return view('livewire.modules.workday-diary.table-actions');
    }
}
