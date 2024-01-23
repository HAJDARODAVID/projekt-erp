<?php

namespace App\Livewire\HidroProjekt\Wp;

use Livewire\Component;
use App\Services\HidroProjekt\WP\ConstructionSiteService;

class ConstructionSiteJobDescriptionTextarea extends Component
{
    public $description;
    public $constId;
    private $constSiteService;

    public function mount($description,$constId){
        $this->description;
        $this->constId;
    }

    public function updatedDescription(){
        $this->constSiteService = new ConstructionSiteService;
        $this->constSiteService->updateConstructionSite($this->constId,[
            'job_description' => $this->description
        ]);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.wp.construction-site-job-description-textarea');
    }
}
