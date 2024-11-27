<?php

namespace App\Livewire\Domain\Bde;

use App\Services\HidroProjekt\Domain\WorkReport\WorkReportAttendanceService;
use Livewire\Component;

class WorkReportCard extends Component
{
    public $entry;
    public $workerCount = 0;
    public $cardStyle = NULL;

    const CARD_STYLE_COMPLETE   = 'background: rgb(0,208,3);background: linear-gradient(121deg, rgba(0,208,3,1) 0%, rgba(18,171,23,1) 100%);';
    const CARD_STYLE_INCOMPLETE = 'background: rgb(195,77,34);background: linear-gradient(333deg, rgba(195,77,34,1) 0%, rgba(253,153,45,1) 100%);';

    public function mount(){
        $this->workerCount = (new WorkReportAttendanceService($this->entry->id))->countAllWorkersInAttendance();
        $this->isComplete();
    }

    private function isComplete(){
        $this->cardStyle = self::CARD_STYLE_COMPLETE;

        if(is_null($this->entry->date)){
            return $this->cardStyle = self::CARD_STYLE_INCOMPLETE;
        }

        if(is_null($this->entry->construction_site_id)){
            return $this->cardStyle = self::CARD_STYLE_INCOMPLETE;
        }

        if($this->workerCount <= 0){
            return $this->cardStyle = self::CARD_STYLE_INCOMPLETE;
        }

    }

    public function render()
    {
        return view('livewire.domain.bde.work-report-card');
    }
}
