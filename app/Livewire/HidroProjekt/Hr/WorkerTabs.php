<?php

namespace App\Livewire\HidroProjekt\Hr;

use Exception;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Session;

class WorkerTabs extends Component
{
    public $tabs=[
        1 => [
            'name'=>'Adresa i kontakt',
            'right' => FALSE,
        ],
        2 => [
            'name'=>'Podaci za obračun',
            'right' => FALSE
        ],
        3 => [
            'name'=>'Povijest radnika',
            'right' => FALSE
        ],
        4 => [
            'name'=>'Prava/uloge korisnika',
            'right' => 'can-assign-roles'
        ],
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
        //if there is a change in h_rate od fix_rate set both to NULL
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
        if($value == '' && $column != 'bonus'){
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
        if($this->tabs[$tab]['right']){
            if(in_array($this->tabs[$tab]['right'], Session::get('user_rights'))){
                return $this->activeTab = $tab;
            }else{
                return $this->activeTab = NULL;
            }
        }
        return $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.worker-tabs');
    }
}
