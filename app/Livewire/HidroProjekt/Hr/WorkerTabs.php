<?php

namespace App\Livewire\HidroProjekt\Hr;

use Exception;
use App\Models\User;
use Livewire\Component;
use App\Models\UserRole;
use App\Models\RoleGroup;
use Livewire\Attributes\Url;
use App\Helpers\UserRightsHelper;
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
    public $userRoles;
    public $userInfo;

    public $saveState = [];

    public $groups;

    public function mount(){
        $this->address     = $this->workerModel->getWorkerAddress->toArray();
        $this->contact     = $this->workerModel->getWorkerContact->toArray();
        $this->payrollInfo = $this->workerModel->getWorkerBasicPayrollInfo->toArray();

        $this->address['model']     = $this->workerModel->getWorkerAddress;
        $this->contact['model']     = $this->workerModel->getWorkerContact;
        $this->payrollInfo['model'] = $this->workerModel->getWorkerBasicPayrollInfo;
        $this->groups = $this->getAllRoles();

        $this->userInfo = User::where('worker_id', $this->workerModel->id)->first();
        //dd($this->payrollInfo);
    }

    public function updated($key, $value){
        list($property, $column) = explode('.', $key);
        if(method_exists(get_class($this), 'set'.ucfirst($property))){
            $method = 'set'.ucfirst($property);
            return $this->$method($key, $value);
        }
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

    private function setUserRoles($key, $value){
        list($property, $role) = explode('.', $key);
        if(empty($this->userInfo)){
            unset($this->userRoles[$role]);
            return $this->dispatch('show-alert-modal', [
                'title' => 'ERROR!',
                'message' => "Radnik: ".$this->workerModel->firstName." ".$this->workerModel->lastName.", nema korisnika!",
                'type' => 'danger',
            ]);
        }
        if(!$value){
            UserRole::where('user_id', $this->userInfo->id)->where('role_id', $role)->first()->delete();
        }
        if($value){
            UserRole::create([
                'user_id' => $this->userInfo->id,
                'role_id' => $role,
            ]);
        }
        return $this->userInfo->update(['inv_update' => 1]);
    }

    public function changeActiveTab($tab){
        if($this->tabs[$tab]['right']){
            if((new UserRightsHelper)->hasRight($this->tabs[$tab]['right'])){
                return $this->activeTab = $tab;
            }else{
                return $this->activeTab = NULL;
            }
        }
        return $this->activeTab = $tab;
    }

    private function getAllRoles(){
        return RoleGroup::all();
    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.worker-tabs');
    }
}
