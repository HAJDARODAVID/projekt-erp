<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Models\AttendanceCoOpModel;
use App\Models\CooperatorWorkersModel;
use App\Models\WorkingDayRecordModel;
use Livewire\Component;
use Livewire\Attributes\On;

class CoOpAttendanceModal extends Component
{
    public $activeModal = false;
    public $attendance;
    public $coOpWorker;
    public $attendanceDate;
    public $wdrObj;
    public $itemCounter;

    public $deleteAttendanceBtn = false;

    public $hours = [];

    public $type = [];
    public $miscWorkList = WorkingDayRecordModel::MISC_WORK_LIST;
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
        $this->getAllWorkBooks();

        if(isset($this->hours['misc'])){
            $this->type['miscWork'] = TRUE;
        }
        if(isset($this->hours['work'])){
            $this->type['wdr'] = TRUE;
        }
        
        return $this->activeModal = TRUE;
    }

    public function save(){
        if(isset($this->hours['misc'])){
            foreach($this->hours['misc'] as $key => $item){
                if(!isset($item['table_id']) && ($item['hours'] != 0 || $item['hours'] != "")){
                    AttendanceCoOpModel::create([
                        'worker_id'             => $this->coOpWorker->id,
                        'working_day_record_id' => $key,
                        'work_hours'            => $item['hours'],
                        'date'                  => $this->attendanceDate,
                    ]);
                }
            }
        }
        if(isset($this->hours['work'])){
            foreach($this->hours['work'] as $key => $item){
                if(!isset($item['table_id']) && ($item['hours'] != 0 || $item['hours'] != "")){
                    AttendanceCoOpModel::create([
                        'worker_id'             => $this->coOpWorker->id,
                        'working_day_record_id' => $item['wdr'],
                        'work_hours'            => $item['hours'],
                        'date'                  => $this->attendanceDate,
                    ]);
                }
            }
        }
        
        $this->type = [];
        $this->hours = [];
        $this->activeModal = false;
        return $this->dispatch('refreshWorkHoursComponent');
    }

    public function setType($type){
        if(isset($this->type[$this->workHourTypes[$type]])){
            unset($this->type[$this->workHourTypes[$type]]);
            return;
        }else{
            return $this->type[$this->workHourTypes[$type]] = TRUE;
        }
    }

    public function addItem(){
        $this->hours['work'][$this->itemCounter] = [];
        return $this->itemCounter++;
    }

    public function closeModal(){
        $this->attendance = NULL;
        $this->type = [];
        $this->hours = [];
        return $this->activeModal = false;
    }

    public function delete($data = ['type' => 'all']){
        if($data['type'] == 'all'){
            foreach ($this->attendance as $item){
                $item->delete();
            }
            $this->attendance = NULL;
            $this->type = [];
            $this->deleteAttendanceBtn = false;
            return $this->hours = [];
        }   

        if(isset($data['table_id'])){
            AttendanceCoOpModel::where('id', $data['table_id'])->first()->delete();
        }
        if($data['type'] == 'work'){
            unset($this->hours[$data['type']][$data['key']]);
        }else{
            $this->hours[$data['type']][$data['key']]['hours'] =NULL;
        }
        
        return;

    }

    private function setCoOpWorker($id){
        return $this->coOpWorker = CooperatorWorkersModel::where('id', $id)->with('getCoOpInfo')->first();
    }

    private function setAttendance(){
        $this->attendance = AttendanceCoOpModel::where('worker_id', $this->coOpWorker->id)
            ->where('date', $this->attendanceDate)
            ->where('work_hours', '!=', NULL)->get();
        
        if(!($this->attendance->isEmpty())){
            $this->deleteAttendanceBtn = TRUE;
        }
        if(($this->attendance->isEmpty())){
            $this->deleteAttendanceBtn = false;
        }

        $this->itemCounter = 1;

        if($this->attendance){
            foreach ($this->attendance as $item) {
                if(array_key_exists($item->working_day_record_id, $this->miscWorkList)){
                    $this->hours['misc'][$item->working_day_record_id]=[
                        'table_id' => $item->id,
                        'hours' => $item->work_hours,
                    ];
                }else{
                    $this->hours['work'][$this->itemCounter]=[
                        'wdr' => $item->working_day_record_id,
                        'table_id' => $item->id,
                        'hours' => $item->work_hours,
                    ];
                    $this->itemCounter++;
                }
            }
        }
        return;
    }

    private function getAllWorkBooks(){
        return $this->wdrObj = WorkingDayRecordModel::where('date', $this->attendanceDate)
        ->where('work_type', '!=', 3)
        ->with('getConstructionSite','getUser.getWorker')
        ->get();
    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.co-op-attendance-modal');
    }
}
