<?php

namespace App\Livewire\Domain\TimeTracker;

use App\Models\AttendanceModel;
use App\Models\ConstructionSiteModel;
use App\Models\WorkerModel;
use App\Models\WorkingDayRecordModel;
use App\Services\HidroProjekt\Domain\Workers\Employes\AttendanceService;
use App\Services\HidroProjekt\Domain\WorkReport\DailyWorkReportService;
use Livewire\Component;
use Livewire\Attributes\On;

class DayAttendanceInfoModal extends Component
{
    public $show = FALSE;
    public $worker;
    public $date;
    public $attendance;
    public $attendanceObj;
    public $absenceReasonShtTxt = AttendanceModel::ABSENCE_REASON_SHT_TXT;
    public $wdrObj;
    public $wdr;
    public $newHours = [
        'wdr'   => NULL,
        'cs'    => NULL,
        'hours' => NULL,
        'type' => 1,
    ];
    public $jobSites;
    public $error = [];
    public $saved = [];
    public $oldValue = [];

    private $param;
    public $refreshTable = FALSE;

    #[On('open-attendance-for-day-modal')]
    public function openModal($param){
        $this->refreshTable = FALSE;
        $this->param = $param;
        $this->setUpData()->wdrToArray()->wdrAttendanceArray();
        $this->show = !$this->show;
    }

    public function closeModal(){
        $this->reset('date', 'worker', 'attendanceObj','attendance', 'wdrObj', 'wdr', 'error');
        $this->show = !$this->show;
        if($this->refreshTable){
            return $this->dispatch('refresh-attendance-table')->to(TimeTracker::class);
        }
    }

    public function addToJobSite(){}

    public function addAbsence($type){
        $this->removeAllAttendance();
        $service = new AttendanceService(date: $this->date, worker: $this->worker->id);
        $service->createNewAbsenceAttendance($this->worker->id, $type);  
        $this->attendanceObj = AttendanceModel::where('worker_id', $this->worker->id)->where('date', $this->date)->with('getWDRInfo')->get();
        $this->wdrAttendanceArray();
        $this->refreshTable = true;
    }

    public function addToAttendance(){
        $this->reset('error');
        if($this->newHours['hours'] == ""){
            $this->error['newHours'] = TRUE;
        }
        if($this->newHours['wdr'] == ""){
            $this->error['wdr'] = TRUE;
        }
        if($this->newHours['wdr'] == "new_wdr" && $this->newHours['cs'] == NULL){
            $this->error['cs'] = TRUE;
        }
        if(count($this->error)==0){
            $attService = new AttendanceService(wdrId: $this->newHours['wdr'], date: $this->date, worker: $this->worker->id);
            if($this->newHours['wdr'] == "new_wdr"){
                $wdrService = new DailyWorkReportService($this->newHours['cs'],$this->date);
                $wdrService->createNewWorkReportItem(type: $this->newHours['type'])->createNewWorkReportLog('Zapis kreiran od strane administracije zbog upisata radnih sati radnika.');
                $wdrObj = $wdrService->getWdrObj();
                $attService->setWdr($wdrObj->id);
            }
            $attService->createNewWorkHoursAttendance(null, $this->newHours['hours'], $this->newHours['type']);

            $this->attendanceObj = AttendanceModel::where('worker_id', $this->worker->id)->where('date', $this->date)->with('getWDRInfo')->get();
            $this->wdrObj = WorkingDayRecordModel::where('date',$this->date)->with('getConstructionSite', 'getUser')->get();
            $this->wdrAttendanceArray()->wdrToArray();
            $this->refreshTable = true;
            $this->newHours = [
                'wdr'   => NULL,
                'cs'    => NULL,
                'hours' => NULL,
                'type' => 1,
            ];
        }
    } 

    private function removeAllAttendance(){
        foreach ($this->attendanceObj as $att) {
            $att->delete();
        }
        return $this;
    }

    private function setUpData(){
        $this->worker = WorkerModel::where('id', $this->param['workerID'])->first();
        $this->date = $this->param['date'];
        $this->attendanceObj = AttendanceModel::where('worker_id', $this->param['workerID'])->where('date', $this->date)->with('getWDRInfo')->get();
        $this->wdrObj = WorkingDayRecordModel::where('date',$this->date)->with('getConstructionSite', 'getUser')->get();
        $this->jobSites = ConstructionSiteModel::where('status', ConstructionSiteModel::CONSTRUCTION_STATUS_ACTIVE)->get();
        return $this;
    }

    private function wdrToArray(){
        $array =[];
        foreach ($this->wdrObj as $wdr) {
            $array[$wdr->id] = [
                'jobSite' => $wdr->construction_site_id == NULL ? NULL : $wdr->getConstructionSite->name,
                'groupLeader' => $wdr->getUser->name,
            ];
        }
        $this->wdr = $array;
        return $this;
    }

    private function wdrAttendanceArray(){
        $array =[];
        foreach ($this->attendanceObj as $att) {
            $array[$att->id] = [
                'wdrID' => $att->working_day_record_id,
                'work_hours' => $att->work_hours,
                'absence_reason' => $att->absence_reason,
                'type' => $att->type,
            ];
        }
        $this->attendance = $array;
        return $this;
    }

    public function deleteAttendance($attID){
        $service = new AttendanceService(date: $this->date);
        $service->getAttendanceById($attID)->deleteAttendance();
        unset($this->attendance[$attID]);
        $this->refreshTable = true;
    }

    public function updatingAttendance($key,$value){
        $this->oldValue=[];
        list($attID, $col) = explode('.', $value);
        if($key == "" || $key == 0 || $key == NULL){
            $this->oldValue[$col] = $this->attendance[$attID][$col];
        }        
    }

    public function updatedAttendance($key,$value){
        /**
         * $key => new value
         * $value => attendance id and table column
         */
        $this->saved = [];
        list($attID, $col) = explode('.', $value);
        if(($key == "" || $key == 0 || $key == NULL) && $col=='work_hours'){
            $old = $this->attendance;
            $this->attendance[$attID][$col] = $this->oldValue[$col];
            $this->oldValue=[];
            return;
        }
        if($col == 'wdrID'){
            $col = 'working_day_record_id';
        }
        if($key == 'NULL'){
            $key = NULL;
        }
        $attService = new AttendanceService(date: $this->date);
        $attService->getAttendanceById($attID)->updateAttendance([$col => $key]);
        if($col == 'working_day_record_id'){
            $col = 'wdrID';
        }
        $this->saved[$attID][$col] = TRUE;
        $this->refreshTable = true;
    }

    private function refreshMainTable(){
        $this->refreshTable = TRUE;
        return $this;
    }

    public function render()
    {
        return view('livewire.domain.time-tracker.day-attendance-info-modal');
    }
}
