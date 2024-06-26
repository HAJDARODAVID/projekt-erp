<?php

namespace App\Livewire\HidroProjekt\Adm;

use App\Services\HidroProjekt\ADM\MainInventoryService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StartNewInventoryCheck extends Component
{
    public $newInventoryCheckName;
    public $activeModal = 0;
    public $info = [];

    public function mount(){
        $this->info = [
            'user' => Auth::user()->getWorker,
            'date' => date("Y-m-d"),
        ];
    }

    public function openNewInventoryCheck(){
        $service = new MainInventoryService;
        $service->openNewInventoryCheck($this->newInventoryCheckName);
        return redirect()->route('hp_materialChecking');
    }

    public function modalBtn($show){
        if($show){
            $this->setNewInventoryCheckName();
        }

        if(!$show){
            $this->newInventoryCheckName = NULL;
        }

        return $this->activeModal = $show;
    }

    private function setNewInventoryCheckName(){
        $this->newInventoryCheckName = date("Y-m-d") . '-' . substr(round(microtime(true) * 1000),9);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.start-new-inventory-check');
    }
}
