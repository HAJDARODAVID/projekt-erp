<?php

namespace App\Livewire\HidroProjekt\Bde;

use Livewire\Component;
use App\Services\Months;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;
use App\Services\HidroProjekt\Bde\EmployeeTimeTrackerService;

class BdeEmployeeTimeTracker extends Component
{
    #[Url]
    public $month;

    #[Url]
    public $year;

    public $data;

    public $basicInfo;

    public function mount(){
        $this->getEmployeeTimesForMonth();
    }

    public function updated($key, $value){
        if($key == 'month' || $key == 'year'){
            return $this->getEmployeeTimesForMonth();
        }
    }

    protected function getEmployeeTimesForMonth(){
        $service = (new EmployeeTimeTrackerService($this->month, $this->year, Auth::user()->id))->getEmployeeTimesForMonth();
        $this->basicInfo = $service->getSumming();
        return $this->data = $service->getData();
    }

    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-employee-time-tracker',[
            'allMonths' => Months::MONTHS_HR,
        ]);
    }
}
