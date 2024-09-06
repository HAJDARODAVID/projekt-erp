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
    
    public $selectedReport = 1;
    public $reportComponentName='reports.expenses-by-provider-report';
    public $reports = [
        1 => [
            'name' => 'Pregled troškova po poslužitelju',
            'comp_name' => 'expenses-by-provider-report'
        ],
    ];

    public function mount(){
        Years::getYearsList();
        $this->year = date("Y");
        $this->years = Years::getYearsList();
        $this->data['months'] = Months::MONTHS_HR;
        $service = new ExpensesReportService;
        $this->data['reportData']=$service->getDataForProviderExpensesReport($this->year); 
    }

    private function setReportComponentName(){

    }

    public function render()
    {
        return view('livewire.hidroprojekt.report.expenses-report');
    }
}
