<?php

namespace App\Livewire\HidroProjekt\Adm\Acl;

use App\Models\Resources;
use App\Models\RoleGroup;
use App\Models\RoleResource;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

class GroupsAndResources extends Component
{
    public $roles = [];
    public $selectedRole=NULL;

    public $resources;
    public $selectedResources=[];

    #[Url(as: 'search')]
    public $searchResources;

    public function mount(){
        $this->roles     = $this->getAllRoles();
        $this->resources = $this->getAllResources();
    }

    public function updatedSearchResources($key, $value){
        if($key == ""){
            return $this->resources = $this->getAllResources();
        }
        return $this->resources = Resources::where('resources', 'like', '%' . $key . '%')->get();
    }

    public function updatedSelectedResources($key, $value){
        //key == TRUE or FALSE | value == array key
        if($key){
            return RoleResource::create([
                'role_id'      => $this->selectedRole,
                'resources_id' => $value
            ]);
        }else{
            $rs = RoleResource::where('role_id', $this->selectedRole)->where('resources_id',$value)->first();
            if($rs){
                return $rs->delete();
            }
        }
    }

    public function resetSearch(){
        $this->searchResources = NULL;
        return $this->resources = $this->getAllResources();
    }

    #[On('refresh-roles-grouping')]
    public function refreshRoles(){
        return $this->roles = $this->getAllRoles();
    }

    public function setSelectedRole($role_id){
        $this->selectedRole = $role_id;
        return $this->setSelectedResources();
    }

    private function getAllRoles(){
        return RoleGroup::all();
    }

    #[On('refresh-resources-show')]
    public function refreshResources(){
        return $this->resources = $this->getAllResources();
    }

    private function getAllResources(){
        return Resources::all();
    }

    private function setSelectedResources(){
        $this->selectedResources=[];
        $rr = RoleResource::where('role_id', $this->selectedRole)->get();
        foreach ($rr as $key => $rs) {
            $this->selectedResources[$rs->resources_id]=TRUE;
        }
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.acl.groups-and-resources');
    }
}

