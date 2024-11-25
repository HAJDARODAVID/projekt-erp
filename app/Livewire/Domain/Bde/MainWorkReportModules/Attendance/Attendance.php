<?php

namespace App\Livewire\Domain\Bde\MainWorkReportModules\Attendance;

use App\Models\User;
use App\Services\HidroProjekt\Domain\Workers\Employes\AttendanceService;
use App\Services\HidroProjekt\Domain\WorkReport\WorkReportAttendanceService;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Attendance extends Component
{
    public $wdr;
    public $user;
    public $attendance = [];

    public function mount(){
        $this->setUser();
    }

    public function updatedAttendance($key, $value){
        if(substr($value, strlen($value)-5) == 'hours'){
            list($wdrID, $workerID, $col) = explode('.', $value);
            $service = new AttendanceService($this->wdr['id'], NULL, NULL, $workerID);
            if($service->hasAttendance()){
                $service->updateAttendanceHours($key);
            }
            if(!($service->hasAttendance())){
                $service->createNewWorkHoursAttendance(NULL, $key, $this->wdr['work_type']);
            }
        }
    }

    public function removeFromAttendance($workerId){
        $service = new AttendanceService($this->wdr['id'], NULL, NULL, $workerId);
        if($service->hasAttendance()){
            $service->deleteAttendance();
        }
        unset($this->attendance[$this->wdr['id']][$workerId]);
    }

    #[On('get-attendance-for-db')]
    public function setAttendance(){
        $service = new WorkReportAttendanceService($this->wdr['id']);
        if(!isset($this->attendance[$this->wdr['id']])){
            $this->setArrayKey();
        }
        $this->attendance[$this->wdr['id']] = $service->getAttendanceArrayForBde() + $this->attendance[$this->wdr['id']];
        $this->dispatch('refresh-this')->to(WorkersForAttendanceTable::class);
        return;
    }

    private function setArrayKey(){
        $this->attendance[$this->wdr['id']] = [];
    }
    
    #[On('add-worker-to-attendance')]
    public function addWorkerToAttendance($row = NULL){
        $this->attendance[$this->wdr['id']][$row['id']] = ['name' => $row['firstName'] . ' ' . $row['lastName']];
        return;
    }

    #[On('ask-if-worker-is-in-attendance')]
    public function isWorkerInAttendance($workerID){ 
        if(!isset($this->attendance[$this->wdr['id']])){
            return $this->dispatch('answer-if-worker-is-in-attendance'.$workerID, FALSE);
        }       
        return $this->dispatch('answer-if-worker-is-in-attendance'.$workerID, array_key_exists($workerID, $this->attendance[$this->wdr['id']]));
    }

    private function setUser(){
        $this->user = User::where('id', Auth::user()->id)->with('getWorker')->first();
        return $this;
    }
    public function render()
    {
        return view('livewire.domain.bde.main-work-report-modules.attendance.attendance');
    }
}
