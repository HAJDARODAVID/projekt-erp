<?php

namespace App\Livewire\HidroProjekt\Adm\Acl;

use Livewire\Component;

class GroupsAndResources extends Component
{
    public $roles = [];
    public $selectedRole=NULL;

    private function getAllRoles(){
        return 0;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.acl.groups-and-resources');
    }
}
