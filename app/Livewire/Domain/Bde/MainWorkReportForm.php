<?php

namespace App\Livewire\Domain\Bde;

use App\Models\WorkingDayRecordModel;
use App\Services\HidroProjekt\Domain\JobSite\JobSiteService;
use App\Services\HidroProjekt\Domain\Material\MaterialMovementService;
use App\Services\HidroProjekt\Domain\Material\MovementTypes;
use App\Services\HidroProjekt\Domain\Subcontractors\SubcontractorsAttendanceService;
use App\Services\HidroProjekt\Domain\Workers\Employes\AttendanceService;
use App\Services\HidroProjekt\Domain\WorkReport\WorkReportAttendanceService;
use Livewire\Component;

class MainWorkReportForm extends Component
{
    public $dailyWorkReport;
    public $wdr;
    public $selectedJobSite = NULL;
    public $jobSites = NULL;

    public $bdeWorkTypes = WorkingDayRecordModel::BDE_WORK_TYPES;
    public $workName = WorkingDayRecordModel::WORK_TYPE;

    public $saveStatus=[]; 

    public $countSubCont = 0;
    public $countAtt = 0;

    public $module='main';

    public function mount(){
        $this->dailyWorkReportToArray()->setJobSites()->countSubContInAttendance()->countWorkersInAttendance();
        //REMOVE THIS;
        $item[0] = [
            'mat_id' => 500000,
            'qty' => 15,
        ];
        $service = new MaterialMovementService(MovementTypes::BOOK_TO_CONSUMPTION, $item,4);
        $service->consumer();
    }

    private function setJobSites(){
        $service = new JobSiteService();
        $this->jobSites = $service->getAllJobSites();
        return $this;
    }

    private function dailyWorkReportToArray(){
        $this->wdr = $this->dailyWorkReport->toArray();
        return $this;
    }

    public function updatedWdr($key, $value){
        /**
         * $key = value
         * $value = key
         */
        $this->reset('saveStatus'); 
        if($key == 'NULL' || $key == ''){
            return;
        }
        $this->dailyWorkReport->update([
            $value => $key,
        ]);
        $this->saveStatus = [$value => 'true'];

        $service = new WorkReportAttendanceService($this->wdr['id']);
        $service->updateAllAttendance(['colName' => $value, 'value' => $key]);
    }

    public function deleteWorkReport(){
        $service = new WorkReportAttendanceService($this->dailyWorkReport->id);
        $service->removeAllFromAttendance();
        $this->dailyWorkReport->delete();
        return redirect()->route('home');
    }

    public function returnBtn(){
        if($this->module == 'main'){
            return redirect()->route('home');
        }
        $this->countSubContInAttendance()->countWorkersInAttendance();
        return $this->module = 'main';
    }

    public function selectModule($module){
        return $this->module = $module;
    }

    public function countSubContInAttendance(){
        $service = new SubcontractorsAttendanceService($this->wdr['id']);
        $this->countSubCont = $service->countWorkersInAttendance();
        return $this;
    }

    public function countWorkersInAttendance(){
        $service = new AttendanceService($this->wdr['id']);
        $this->countAtt = $service->countWorkersInAttendance();
        return $this;
    }

    public function render()
    {
        return view('livewire.domain.bde.main-work-report-form');
    }
}
