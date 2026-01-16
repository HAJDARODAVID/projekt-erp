<?php

namespace App\Livewire\Modules\Employees;

use Livewire\Attributes\Url;
use App\Models\Employees\Workplace;
use App\Livewire\LivewireController;

class WorkplacesInfo extends LivewireController
{
    #[Url('search')]
    public $workplaceSearch = NULL;

    /**Selected workplace */
    #[Url('workplace')]
    public $selectedWorkplace = NULL;

    /**Registered workplaces */
    public $workplaces = [];

    public function mount()
    {
        $this->getWorkplaces();
    }

    /**
     * Get all workplaces.
     * This will consider $this->moduleSearch property
     */
    private function getWorkplaces()
    {
        $workplaces = new Workplace();
        if ($this->workplaceSearch) {
            $workplaces = $workplaces->where('name', 'LIKE', '%' . $this->workplaceSearch . '%');
        }
        $workplaces = $workplaces->orderBy('name', 'ASC');
        return $this->workplaces = $workplaces->select('id', 'name', 'status')->get()->toArray();
    }

    /**
     * Select a workplace and show more info 
     */
    public function selectWorkplace($id)
    {
        if ($this->selectedWorkplace == $id) {
            $this->selectedWorkplace = NULL;
        } else {
            $this->selectedWorkplace = $id;
        }
    }

    public function render()
    {
        return view('livewire.modules.employees.workplaces-info');
    }
}
