<?php

namespace App\Livewire\Domain\Attendance;

use Livewire\Component;
use App\Models\WorkerModel;
use App\Services\HidroProjekt\Domain\Workers\Employes\AttendanceService;

/**
 * In this component you will have the components for adding workers to the report.
 */
class AddWorkersToReportComponent extends Component
{
    /**
     * In here you will have the work diary ID. 
     */
    public $wdr;

    /**
     * Here will be the input from the search box.
     */
    public $workerSearch;

    /**
     * Store all the findings from the search here.
     */
    public $workers;

    /**
     * Store the workers who are added to the attendance.
     */
    public $attendance = [];

    /**
     * All the user input errors
     */
    public $error = [];

    /**
     * This method is triggered on the change event on the property $workerSearch.
     * The result will be stored in the $workers property
     */
    public function updatedWorkerSearch($key){
        if($key==""){
            return $this->workers = NULL;
        }
        return $this->workers = WorkerModel::where('firstName', 'like', '%'.$key.'%')
        ->orWhere('lastName', 'like', '%'.$key.'%')->get();
    }

    /**
     * This method will be triggered when you click on a worker to be added to attendance.
     */
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

    /**
     * This method will be triggered when you click on the trash btn to be removed from attendance.
     */
    public function removeFromAtt($key){
        unset($this->attendance[$key]);
        if(count($this->attendance) == 0){
            $this->attendance = [];
        }
    }

    /**
     * Reset the search input
     */
    public function emptySearch(){
        $this->workers = NULL;
        $this->workerSearch = NULL;
        return;
    }

    /**
     * In this method we will check if all the data is ok before saving.
     * If there is a error it will be put in the $error property.
     */
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
        return count($this->error) > 0 ? FALSE : TRUE;
    }

    /**
     * Add the workers from the attendance $property to the DB.
     */
    public function save(){
        $validation = $this->dataValidation();
        if($validation){
            $attService = new AttendanceService(
                $this->wdr->id,
                $this->wdr->jobType,
                $this->wdr->date
            );
            foreach ($this->attendance as $att) {
                $workerAttendance = new AttendanceService($this->wdr->id, $this->wdr->jobType, $this->wdr->date, $att['id']);
                if($workerAttendance->hasAttendance()){
                    $workerAttendance->updateAttendanceHours($att['hours']);
                }else{
                    $attService->createNewWorkHoursAttendance($att['id'], $att['hours']);
                }
            }
            $this->dispatch('refresh-attendance-table-for-daily-report')->to(AttendanceTableForDailyReport::class);
            $this->reset('attendance', 'error', 'workerSearch', 'workers');
        }
        return;
    }

    public function render()
    {
        return view('livewire.domain.attendance.add-workers-to-report-component');
    }
}
