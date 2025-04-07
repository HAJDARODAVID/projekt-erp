<?php

namespace App\Livewire\Domain\TimeTracker;

use App\Models\User;
use App\Models\WorkerModel;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class TimeTrackerPerWorker extends Component
{
    public $workerList;

    #[Url('worker')]
    public $selectedWorker = NULL;

    #[Url('worker-search')]
    public $workerSearch = NULL;

    public function mount(){
        $this->workerList = $this->getAllWorkers()->get();
    }

    #[On('select-worker')]
    public function selectWorker($workerID){
        if($this->selectedWorker == $workerID){
            $this->selectedWorker = NULL;
        }else{
            $this->selectedWorker = $workerID;
        }
        $this->workerSearch = NULL;
        $this->workerList = $this->getAllWorkers()->get();
        $this->dispatch('updated-selected-worker', $this->selectedWorker)->to(TimeTrackerWorkerInfoContainer::class);
    }

    public function updatedWorkerSearch($key,$value){
        if($key==""){
            $this->workerSearch = NULL;
            $this->workerList = $this->getAllWorkers()->get();
            return;
        }
        $this->workerList = $this->getAllWorkers()->where('firstName','LIKE','%'.$this->workerSearch.'%')
            ->orWhere('lastName','LIKE','%'.$this->workerSearch.'%')->get();
        return;
    }

    private function getAllWorkers(){
        $leaders = User::where('type', 3)->pluck('worker_id')->toArray();
        $workers = WorkerModel::where('is_worker', 1)->pluck('id')->toArray();
        $allID = array_merge($leaders,$workers);
        sort($allID);
        $allWorkers = WorkerModel::whereIn('id', $allID);
        if($this->workerSearch){
            $allWorkers->where('firstName','LIKE','%'.$this->workerSearch.'%')
            ->orWhere('lastName','LIKE','%'.$this->workerSearch.'%');
        }
        return $allWorkers;
    }

    public function render()
    {
        return view('livewire.domain.time-tracker.time-tracker-per-worker');
    }
}
