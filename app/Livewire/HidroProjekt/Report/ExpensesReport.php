<?php

namespace App\Livewire\HidroProjekt\Report;

use App\Services\HidroProjekt\REPORT\ExpensesReportService;
use App\Services\Months;
use App\Services\Years;
use Livewire\Component;


class ExpensesReport extends Component
{
    public $data;
    public $year;
    public $years;
    
    public $selectedReport;
    public $reportComponentName;
    public $reports = [
        1 => [
            'name' => 'Pregled troškova po poslužitelju',
            'comp_name' => 'expenses-by-provider-report',
            'config' => FALSE,
        ],
        2 => [
            'name' => 'Pregled troškova - grupirane kategorije',
            'comp_name' => 'expenses-by-grouped-categories',
            'config' => TRUE,
        ],
    ];

    public function mount(){
        $this->year = date("Y");
        $this->years = Years::getYearsList();
        $this->data['months'] = Months::MONTHS_HR;
        $this->setReportComponent();
        $service = new ExpensesReportService;
        $this->data['reportData']=$service->getDataForProviderExpensesReport($this->year); 
    }

    private function setReportComponent($comp=1){
        $this->selectedReport = $comp;
        $this->reportComponentName = 'reports.' . $this->reports[$comp]['comp_name'];
    }

    public function render()
    {
        return view('livewire.hidroprojekt.report.expenses-report');
    }
}
