<?php

namespace App\Livewire\HidroProjekt\Report;

use App\Services\HidroProjekt\REPORT\ExpensesReportService;
use App\Services\Months;
use Livewire\Component;


class ExpensesReport extends Component
{
    public $months = Months::MONTHS_HR;
    public $reportData;

    public function mount(){
        $service = new ExpensesReportService;
        $this->reportData=$service->getDataForProviderExpensesReport(2024);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.report.expenses-report');
    }
}
