<?php

namespace App\Livewire\Domain\Bde\MainWorkReportModules\WorkDiary;

use Livewire\Component;
use App\Models\WorkingDayLogModel;
use App\Services\HidroProjekt\Domain\WorkReport\DailyWorkReportService;

class WorkDiary extends Component
{
    public $wdr;
    public $allDiaries;
    public $diaryTxt;
    public $edit = NULL;

    public function mount(){
        $this->allDiaries = WorkingDayLogModel::where('working_day_record_id', $this->wdr['id'])->orderBy('id', 'desc')->get();
    }

    public function saveDiary(){
        if(!is_null($this->edit)){
            $this->edit['obj']->update([
                'log' => $this->diaryTxt,
            ]);
            $this->allDiaries = WorkingDayLogModel::where('working_day_record_id', $this->wdr['id'])->orderBy('id', 'desc')->get();
            $this->reset('diaryTxt');
            return;
        }
        if(is_null($this->diaryTxt) || $this->diaryTxt == '' ){
            return;
        }
        $service = (new DailyWorkReportService())->findById($this->wdr['id']);
        $service->createNewWorkReportLog($this->diaryTxt);
        $this->allDiaries = WorkingDayLogModel::where('working_day_record_id', $this->wdr['id'])->orderBy('id', 'desc')->get();
        $this->reset('diaryTxt');
        return;
    }

    public function deleteDiary($id){
        WorkingDayLogModel::where('id', $id)->first()->delete();
        $this->allDiaries = WorkingDayLogModel::where('working_day_record_id', $this->wdr['id'])->orderBy('id', 'desc')->get();
    }

    public function editDiary($id){
        $this->edit=[
            'obj' => WorkingDayLogModel::where('id', $id)->first(),
        ];
        $this->diaryTxt = $this->edit['obj']->log;
    }

    public function render()
    {
        return view('livewire.domain.bde.main-work-report-modules.work-diary.work-diary');
    }
}
