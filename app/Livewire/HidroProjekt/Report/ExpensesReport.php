<?php

namespace App\Livewire\HidroProjekt\Report;

use App\Services\HidroProjekt\REPORT\ExpensesReportService;
use App\Services\Months;
use Livewire\Component;


class ExpensesReport extends Component
{
    public $data;
    public $year;
    public $activeReport='reports.expenses-by-provider-report';

    public function mount(){
        $this->year = date("Y");
        $this->data['months'] = Months::MONTHS_HR;
        $service = new ExpensesReportService;
        $this->data['reportData']=$service->getDataForProviderExpensesReport($this->year);
        
    }

    public function render()
    {
        return view('livewire.hidroprojekt.report.expenses-report');
    }
}
