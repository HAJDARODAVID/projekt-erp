<?php

namespace App\Livewire\HidroProjekt\Adm\Acl;

use Livewire\Component;
use App\Models\ModuleItemsRouteModel;
use Illuminate\Support\Facades\Route;

class ModulesRightsContainer extends Component
{
    public function render()
    {
        return view('livewire.hidroprojekt.adm.acl.modules-rights-container');
    }
}
