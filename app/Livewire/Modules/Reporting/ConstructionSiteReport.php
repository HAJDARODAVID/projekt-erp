<?php

namespace App\Livewire\Modules\Reporting;

use App\Livewire\LivewireController;
use App\Models\Jobs\ConstructionSite;
use App\Services\ConstructionSite\GetConstructionSiteReportDataService;
use App\Services\ConstructionSite\GetAllConstructionSiteReportDataService;

class ConstructionSiteReport extends LivewireController
{
    public $search;

    public $reportData;

    public function mount()
    {
        $this->getReportData();
        $this->enableArraySearch();
    }

    public function boot()
    {
        $this->setSearchProperty('search')
            ->setArraySearchProperty('reportData')
            ->setArraySearchKey('jobSiteName');
    }

    public function updatedSearch($value)
    {
        if ($value == "") $this->search = NULL;
        $this->searchArray();
    }


    /**
     * This method will populate the properties with the necessary data
     * 
     * @return self
     */
    private function getReportData()
    {
        try {
            $service = (new GetAllConstructionSiteReportDataService())->execute();
            if ($service->getResponse()['success']) {
                $this->reportData = $service->getResponse()['data'];
            } else {
                $this->showException($service->getResponse()['message']);
            }
        } catch (\Throwable $th) {
            $this->showException($th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.modules.reporting.construction-site-report');
    }
}
