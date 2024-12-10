<?php

namespace App\Livewire\Domain\TimeTracker;

use App\Models\AttendanceModel;
use App\Models\WorkerModel;
use App\Models\WorkingDayRecordModel;
use App\Services\HidroProjekt\Domain\Workers\Employes\AttendanceService;
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

    private $param;
    private $refreshTable = FALSE;

    #[On('open-attendance-for-day-modal')]
    public function openModal($param){
        $this->refreshTable = FALSE;
        $this->param = $param;
        $this->setUpData()->wdrToArray()->wdrAttendanceArray();
        $this->show = !$this->show;
    }

    public function closeModal(){
        if($this->refreshTable){
            $this->dispatch('refresh-attendance-table')->to(TimeTracker::class);
        }
        $this->reset('date', 'worker', 'attendanceObj','attendance', 'wdrObj', 'wdr');
        $this->show = !$this->show;
    }

    private function setUpData(){
        $this->worker = WorkerModel::where('id', $this->param['workerID'])->first();
        $this->date = $this->param['date'];
        $this->attendanceObj = AttendanceModel::where('worker_id', $this->param['workerID'])->where('date', $this->date)->with('getWDRInfo')->get();
        $this->wdrObj = WorkingDayRecordModel::where('date',$this->date)->with('getConstructionSite', 'getUser')->get();
        return $this;
    }

    private function wdrToArray(){
        $array =[];
        foreach ($this->wdrObj as $wdr) {
            $array[$wdr->id] = [
                'jobSite' => $wdr->getConstructionSite->name,
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

    public function render()
    {
        return view('livewire.domain.time-tracker.day-attendance-info-modal');
    }
}
