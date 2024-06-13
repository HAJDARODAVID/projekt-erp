<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Models\AttendanceModel;
use App\Models\WorkerModel;
use Livewire\Component;
use App\Models\WorkingDayRecordModel;
use Livewire\Attributes\On;
class WorkerAttendanceModal extends Component
{
    public $activeModal = false;
    public $attendance;
    public $worker;
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

    #[On('open-worker-attendance-modal')]
    public function openModal($data=null){
        $this->attendanceDate = $data['date'];
        if($data['workerId']){
            $this->setWorker($data['workerId']);
        }
        $this->setAttendance();
        $this->getAllWorkBooks();

        if(isset($this->hours['work'])){
            $this->type['wdr'] = TRUE;
        }
        
        return $this->activeModal = TRUE;
    }

    public function updatedHours($key, $value){
        list($type, $aKey, $column) = explode('.', $value);
        if(isset($this->hours[$type][$aKey]['table_id'])){
            $attendanceData = AttendanceModel::where('id', $this->hours[$type][$aKey]['table_id'])->first();
            if($column == 'hours' && ($key != 0 && $key != "")){
                $attendanceData->update([
                    'work_hours' => $key,
                ]);
                return;
            }
            if($column == 'wdr' && ($key != 0 && $key != "" && $key != NULL)){
                $attendanceData->update([
                    'working_day_record_id' => $key,
                ]);
                return;
            }
        }
        
    }

    public function save(){
        if(isset($this->hours['misc'])){
            foreach($this->hours['misc'] as $key => $item){
                if(!isset($item['table_id']) && ($item['hours'] != 0 || $item['hours'] != "")){
                    AttendanceModel::create([
                        'worker_id'             => $this->worker->id,
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
                    AttendanceModel::create([
                        'worker_id'             => $this->worker->id,
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
        return $this->dispatch('refreshWorkHoursComponentHPWorker');
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
            AttendanceModel::where('id', $data['table_id'])->first()->delete();
        }
        if($data['type'] == 'work'){
            unset($this->hours[$data['type']][$data['key']]);
        }else{
            $this->hours[$data['type']][$data['key']]['hours'] =NULL;
        }
        
        return;

    }

    private function setWorker($id){
        return $this->worker = WorkerModel::where('id', $id)->first();
    }

    private function setAttendance(){
        $this->attendance = AttendanceModel::where('worker_id', $this->worker->id)
            ->where('date', $this->attendanceDate)->get();
        
        if(!($this->attendance->isEmpty())){
            $this->deleteAttendanceBtn = TRUE;
        }
        if(($this->attendance->isEmpty())){
            $this->deleteAttendanceBtn = false;
        }

        $this->itemCounter = 1;

        foreach($this->miscWorkList as $key => $typeOfWork){
            $this->hours['misc'][$key]=[];
        }

        if($this->attendance){
            foreach ($this->attendance as $item) {
                if(array_key_exists($item->working_day_record_id, $this->miscWorkList)){
                    $this->hours['misc'][$item->working_day_record_id]=[
                        'table_id' => $item->id,
                        'hours' => $item->work_hours,
                    ];
                    $this->type['miscWork'] = TRUE;
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
        ->where('construction_site_id', '!=', NULL)
        ->with('getConstructionSite','getUser.getWorker')
        ->get();
    }
    
    public function render()
    {
        return view('livewire.hidroprojekt.hr.worker-attendance-modal');
    }
}
