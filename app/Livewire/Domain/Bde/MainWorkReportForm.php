<?php

namespace App\Livewire\Domain\Bde;

use App\Services\HidroProjekt\Domain\JobSite\JobSiteService;
use Livewire\Component;

class MainWorkReportForm extends Component
{
    public $selectedJobSite = NULL;
    public $jobSites = NULL;

    public function mount(){
        $this->setJobSites();
    }

    private function setJobSites(){
        $service = new JobSiteService();
        return $this->jobSites = $service->getAllJobSites();
    }

    public function render()
    {
        return view('livewire.domain.bde.main-work-report-form');
    }
}
