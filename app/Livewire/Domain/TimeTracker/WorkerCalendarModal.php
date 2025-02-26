<?php

namespace App\Livewire\Domain\TimeTracker;

use App\Models\WorkerModel;
use App\Services\HidroProjekt\Domain\Calendar\CalendarDates;
use App\Services\HidroProjekt\Domain\Workers\Employes\AttendanceItemService;
use Livewire\Component;
use Livewire\Attributes\On;

class WorkerCalendarModal extends Component
{
    public $show = FALSE;
    public $param;
    public $workerInfo;
    public $attendanceData;
    public $selectedDates = [];

    #[On('open-calendar-modal')]
    public function openModal($param){
        $this->param = $param;
        $this->setWorkerInfo()
            ->setAttendanceData();
        $this->show = !$this->show;
    }

    #[On('refresh-attendance-calendar')]
    public function refreshData(){
        return $this->setWorkerInfo()
        ->setAttendanceData();
    }

    public function closeModal(){
        $this->reset('param', 'workerInfo');
        $this->show = !$this->show;
        // if($this->refreshTable){
        //     return $this->dispatch('refresh-attendance-table')->to(TimeTracker::class);
        // }
    }

    private function setWorkerInfo(){
        if(isset( $this->param['workerID'])){
            $this->workerInfo = WorkerModel::where('id',  $this->param['workerID'])->first();
        }
        return $this;
    }

    private function setAttendanceData(){
        if(isset( $this->param['workerID'])){
            $calendarDates = CalendarDates::getDatesForCalendar($this->param['month'],$this->param['year']);
            foreach($calendarDates as $cw => $dates){
                foreach($dates as $date => $dateInfo){
                    $calendarDates[$cw][$date]['att'] = AttendanceItemService::init()->date($dateInfo['date']->format("Y-m-d"))->worker($this->workerInfo->id)->find()->get();
                }
            }
            $this->attendanceData = $calendarDates;
        }
        return $this;
    }

    #[On('add-to-selected-dates-array')]
    public function addToSelectedDates($date=NULL,$type=1){
        /**
         * Types: 1->single, 2->array
         */
        switch ($type) {
            case 1:
                $this->selectedDates = [];
                return $this->selectedDates[] = $date;
                break;
            case 2:
                $key = array_search($date,$this->selectedDates);
                if($key === FALSE){
                    return $this->selectedDates[] = $date;  
                }else{
                    unset($this->selectedDates[$key]);
                    return;
                }
                break;
        }
    }

    /**
     * Open the modal for one day info.
     */
    public function showModalForDay($param=NULL){
        $param = [
            'date' => $this->selectedDates[0],
            'workerID' => $this->workerInfo->id,
        ];
        $this->dispatch('open-attendance-for-day-modal', $param)->to(DayAttendanceInfoModal::class);
    }

    public function render()
    {
        return view('livewire.domain.time-tracker.worker-calendar-modal');
    }
}
