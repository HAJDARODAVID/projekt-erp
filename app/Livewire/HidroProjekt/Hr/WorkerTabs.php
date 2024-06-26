<?php

namespace App\Livewire\HidroProjekt\Hr;

use Exception;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Validate;

class WorkerTabs extends Component
{
    public $tabs=[
        1 => 'Adresa i kontakt',
        2 => 'Podaci za obračun',
        3 => 'Povijest radnika',
    ];

    #[Url(as: 'tab')]
    public $activeTab;

    public $workerModel;

    public $address;
    public $contact;
    public $payrollInfo;

    public $saveState = [];

    public function mount(){
        $this->address     = $this->workerModel->getWorkerAddress->toArray();
        $this->contact     = $this->workerModel->getWorkerContact->toArray();
        $this->payrollInfo = $this->workerModel->getWorkerBasicPayrollInfo->toArray();

        $this->address['model']     = $this->workerModel->getWorkerAddress;
        $this->contact['model']     = $this->workerModel->getWorkerContact;
        $this->payrollInfo['model'] = $this->workerModel->getWorkerBasicPayrollInfo;
        //dd($this->payrollInfo);
    }

    public function updated($key, $value){
        list($property, $column) = explode('.', $key);
        if($column == 'bonus'){
            dd($key, $value);
        }
        //if the is a change in h_rate od fix_rate set both to NULL
        if($column == 'h_rate' || $column == 'fix_rate'){
            $this->$property['model']->update([
                'h_rate'   => NULL,
                'fix_rate' => NULL,
            ]);
        }
        //check if travel_exp or phone_exp are empty
        if(($column=='travel_exp' && $value == '') || ($column=='phone_exp' && $value == '')){
            $value = 0;
            $this->payrollInfo[$column] = 0;
        }
        if($value == ''){
            $value = NULL;
        }
        try {
            $this->$property['model']->update([
                $column => $value,
            ]);
            $this->saveState[$column] = TRUE;
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function changeActiveTab($tab){
        return $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.worker-tabs');
    }
}
