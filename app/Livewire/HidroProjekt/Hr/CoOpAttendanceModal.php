<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Models\AttendanceCoOpModel;
use App\Models\CooperatorWorkersModel;
use Livewire\Component;
use Livewire\Attributes\On;

class CoOpAttendanceModal extends Component
{
    public $activeModal = false;
    public $attendance;
    public $coOpWorker;
    public $attendanceDate;

    public $hours = NULL;

    public $type = NULL;
    public $workHourTypes=[
        1 => 'miscWork',
        2 => 'wdr',
    ];

    #[On('open-co-op-attendance-modal')]
    public function openModal($data=null){
        $this->attendanceDate = $data['date'];
        if($data['workerId']){
            $this->setCoOpWorker($data['workerId']);
        }
        $this->setAttendance();

        

        if(!is_null($this->attendance)){
            if($this->attendance->working_day_record_id === 532){
                $this->type = 'miscWork';
            }else{
                $this->type = 'wdr';
            }
        }
        
        return $this->activeModal = TRUE;
    }

    public function save(){
        if($this->type == 'miscWork'){
            AttendanceCoOpModel::create([
                'worker_id' => $this->coOpWorker->id, 
                'working_day_record_id' => 532, 
                'work_hours' => $this->hours, 
                'date' => $this->attendanceDate,
            ]);
        }

        $this->type = NULL;
        $this->hours = NULL;
        $this->activeModal = false;
        return $this->dispatch('refreshWorkHoursComponent');
    }

    public function setType($type){
        return $this->type = $this->workHourTypes[$type];
    }

    public function closeModal(){
        $this->attendance = NULL;
        $this->type = NULL;
        $this->hours = NULL;
        return $this->activeModal = false;
    }

    public function delete(){
        $this->attendance->delete();
        $this->attendance = NULL;
        $this->type = NULL;
        return $this->hours = NULL;
    }

    private function setCoOpWorker($id){
        return $this->coOpWorker = CooperatorWorkersModel::where('id', $id)->with('getCoOpInfo')->first();
    }

    private function setAttendance(){
        $this->attendance = AttendanceCoOpModel::where('worker_id', $this->coOpWorker->id)
            ->where('date', $this->attendanceDate)
            ->where('work_hours', '!=', NULL)->first();
        if($this->attendance){
            $this->hours = $this->attendance->work_hours;
        }
        return;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.co-op-attendance-modal');
    }
}
