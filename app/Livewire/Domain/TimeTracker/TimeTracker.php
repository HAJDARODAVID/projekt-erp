<?php

namespace App\Livewire\Domain\TimeTracker;

use App\Services\Years;
use Livewire\Component;
use Livewire\Attributes\Url;
use App\Services\HidroProjekt\Domain\Workers\TimeTracker\TImeTrackerService;
use App\Services\Months;
use Livewire\Attributes\On;

class TimeTracker extends Component
{
    public $years;
    public $months = Months::MONTHS_HR;
    public $days;

    #[Url(as: 'month')]
    public $selMonth = NULL;
    #[Url(as: 'year')]
    public $selYear = NULL;
    public $data;

    public function mount(){
        $this->years = Years::getYearsList();        
        $this->selMonth = $this->selMonth == NULL ?  date('n') : $this->selMonth;
        $this->selYear = $this->selYear == NULL ?  date('Y') : $this->selYear;
        $this->setDays()->setTimeTrackerData();
    }

    public function updatedSelector(){
        $this->setDays()->setTimeTrackerData();
    }

    public function updatedSelMonth(){
        $this->setDays()->setTimeTrackerData();
    }
    public function updatedSelYear(){
        $this->setDays()->setTimeTrackerData();
    }

    private function setDays(){
        $this->days = Months::dayOfMonth($this->selMonth, $this->selYear);
        return $this;
    }

    private function setTimeTrackerData(){
        $service = new TImeTrackerService($this->selMonth, $this->selYear);
        $this->data = $service->getData();
        return $this;
    }

    /**THIS WILL BE CHANGED */
    public function showModalForDay($param=NULL){
        $param = $this->parametersToArray($param);
        $this->dispatch('open-worker-info',$param)->to(TimeTrackerModule::class);
    }

    public function showCalendarModal($param=NULL){
        $param = $this->parametersToArray($param);
        $this->dispatch('open-calendar-modal', $param)->to(WorkerCalendarModal::class);
    }

    private function parametersToArray($param){
        $array = [];
        $paramPair = explode(',',$param);
        foreach ($paramPair as $oneParam) {
            list($key, $value) = explode('.',$oneParam);
            $array[$key] = $value;
        }
        return $array;
    }

    #[On('refresh-attendance-table')]
    public function refreshThis(){
        return $this->setDays()->setTimeTrackerData();
    }

    public function render()
    {
        return view('livewire.domain.time-tracker.time-tracker');
    }
}
