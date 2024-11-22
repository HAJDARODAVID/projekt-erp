<?php

namespace App\Livewire\Domain\Bde;

use App\Models\WorkingDayRecordModel;
use App\Services\HidroProjekt\Domain\JobSite\JobSiteService;
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

    public $module='main';

    public function mount(){
        $this->dailyWorkReportToArray()->setJobSites();
        //dd($this->wdr);
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
    }

    public function deleteWorkReport(){
        $this->dailyWorkReport->delete();
        return redirect()->route('home');
    }

    public function returnBtn(){
        if($this->module == 'main'){
            return redirect()->route('home');
        }
        return $this->module = 'main';
    }

    public function selectModule($module){
        return $this->module = $module;
    }

    public function render()
    {
        return view('livewire.domain.bde.main-work-report-form');
    }
}
