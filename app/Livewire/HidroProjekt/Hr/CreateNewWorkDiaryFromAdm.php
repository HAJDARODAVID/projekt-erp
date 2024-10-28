<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Models\WorkerModel;
use App\Models\WorkingDayRecordModel;
use Livewire\Component;
use App\Services\HidroProjekt\Domain\JobSite\JobSiteService;
use App\Services\HidroProjekt\Domain\Workers\Employes\AttendanceService;
use App\Services\HidroProjekt\Domain\Workers\Employes\ConstructionSuperintendentService;
use App\Services\HidroProjekt\Domain\WorkReport\DailyWorkReportService;

class CreateNewWorkDiaryFromAdm extends Component
{
    public $show=FALSE;
    public $leaders = NULL;
    public $selectedLeader = NULL;
    public $jobSites = NULL;
    public $date;
    public $constSite;
    public $workers = NULL;
    public $workerSearch;

    public $attendance = [];

    public $jobType = WorkingDayRecordModel::WORK_TYPE_HOME;

    public $error = [];

    public function modalToggle(){
        $this->show = $this->show ? FALSE : TRUE;
        if($this->show){
            $this->setData();
        }
        return;
    }

    public function save(){
        $validation = $this->dataValidation();
        if($validation){
            $workReport = new DailyWorkReportService($this->constSite, $this->date);
            if($this->selectedLeader != NULL || $this->selectedLeader != ""){
                $workReport = $workReport->setDifferentUser($this->selectedLeader);
            }
            $workReport = $workReport->createNewWorkReportItem(type: $this->jobType);
            $attService = new AttendanceService(
                $workReport->getWdrObj()->id,
                $this->jobType,
                $this->date
            );
            foreach ($this->attendance as $att) {
                $attService->createNewWorkHoursAttendance($att['id'], $att['hours']);
            }
            return redirect()->route('hp_allWorkHours')->with('success', 'Uspješno kreiran zapis radnog dana!');
        }
        return;
    }

    public function emptySearch(){
        $this->workers = NULL;
        $this->workerSearch = NULL;
        return;
    }

    public function addToAttendance($id){
        $worker = WorkerModel::where('id',$id)->first();
        foreach ($this->attendance as $array) {
            if(in_array($worker->id,$array)){
                return;
            }
        }
        $this->attendance[] = [
            'id' => $worker->id,
            'worker' => $worker->fullName,
            'hours' => NULL,
        ];
        $this->workers = NULL;
        $this->workerSearch = NULL;
        return;
    }

    public function removeFromAtt($key){
        unset($this->attendance[$key]);
        if(count($this->attendance) == 0){
            $this->attendance = NULL;
        }
    }

    public function updatedWorkerSearch($key){
        if($key==""){
            return $this->workers = NULL;
        }
        return $this->workers = WorkerModel::where('firstName', 'like', '%'.$key.'%')
        ->orWhere('lastName', 'like', '%'.$key.'%')->get();
    }

    public function updatedSelectedLeader($key){
        $leader = (new ConstructionSuperintendentService)->getSuperintendentById($key);
        $this->addToAttendance($leader->worker_id);
    }

    private function setData(){
        $this->leaders = (new ConstructionSuperintendentService)->getAllSuperintendents();
        $this->jobSites = (new JobSiteService)->getAllJobSites();
    }

    private function resetAll(){

    }

    private function dataValidation(){
        //reset errors
        $this->error = [];
        //check attendance
        if(is_array($this->attendance)){
            foreach ($this->attendance as $array) {
                if($array['hours'] == NULL || $array['hours'] == "" || $array['hours'] == 0){
                    $this->error['att'][$array['id']]=TRUE;
                }
            }
        }
        
        //check date
        if($this->date == NULL || $this->date == ""){
            $this->error['date']=TRUE;
        }

        //check construction site
        if($this->constSite == NULL || $this->constSite == ""){
            $this->error['constSite']=TRUE;
        }

        return count($this->error) > 0 ? FALSE : TRUE;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.create-new-work-diary-from-adm');
    }
}
