<?php

namespace App\Livewire\HidroProjekt\Hr;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\CooperatorsModel;
use App\Models\CooperatorWorkersModel;
use App\Livewire\HidroProjekt\Hr\WorkHoursCoOpReport;
use App\Exports\Domain\Workers\Cooperators\CoOpWorkHoursExport;
use App\Services\HidroProjekt\Domain\Workers\Cooperators\CooperatorsExportWorkHoursService;

class CoOpWorkHoursExportModal extends Component
{
    public $year;
    public $month;
    public $coOpInfo;

    public $show = FALSE;

    public function toggleModal(){
        if($this->show==FALSE){
            $this->setUpData();
        }
        return $this->show = $this->show ? FALSE : TRUE;
    }

    private function setUpData(){
        try {
            $coOps=CooperatorsModel::where('status', CooperatorWorkersModel::COOPERATORS_WORKER_STATUS_ACTIVE)->pluck('name', 'id')->toArray();
            foreach ($coOps as $key => $value) {
                $coOps[$key]=NULL;
                $coOps[$key]['name'] = $value;
                $coOps[$key]['hasAtt'] = (new CooperatorsExportWorkHoursService($key, $this->month, $this->year))->isEmpty();
            }
            return $this->coOpInfo = $coOps;
        } catch (\Exception $e) {
            return $this->dispatch('show-alert-modal', [
                'title' => 'ERROR!',
                'message' => $e->getMessage(),
                'type' => 'danger',
            ]);
        }
    }

    public function exportExcel($coOp){
        try {
            $attObj = new CooperatorsExportWorkHoursService($coOp, $this->month, $this->year);
            return (new CoOpWorkHoursExport($attObj->getAttendanceList(), $attObj->getSummarizedAttendance()))->download($this->coOpInfo[$coOp]['name'] ." šihterica M" . $this->month.'.xlsx');
        } catch (\Exception $e) {
            return $this->dispatch('show-alert-modal', [
                'title' => 'ERROR!',
                'message' => $e->getMessage(),
                'type' => 'danger',
            ]);
        }
    }


    public function render()
    {
        return view('livewire.hidroprojekt.hr.co-op-work-hours-export-modal');
    }
}
