<?php

namespace App\Livewire\Modules\Employees\Components;

use App\Livewire\LivewireController;

class TableActions extends LivewireController
{
    public $row;
    public function render()
    {
        return view('livewire.modules.employees.components.table-actions');
    }
}
