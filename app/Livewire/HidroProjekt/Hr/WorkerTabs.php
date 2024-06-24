<?php

namespace App\Livewire\HidroProjekt\Hr;

use Livewire\Component;
use Livewire\Attributes\Url;

class WorkerTabs extends Component
{
    public $tabs=[
        1 => 'Adresa i kontakt',
        2 => 'Obračun'
    ];

    #[Url(as: 'tab')]
    public $activeTab;

    public $workerModel;

    public $address;
    public $contact;

    public function mount(){
        $this->address= $this->workerModel->getWorkerAddress->toArray();
        $this->contact= $this->workerModel->getWorkerContact->toArray();
        //dd($this->workerModel);
    }

    public function changeActiveTab($tab){
        return $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.worker-tabs');
    }
}
