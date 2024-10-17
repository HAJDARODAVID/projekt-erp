<?php

namespace App\Exports\Domain\Expenses;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Domain\Expenses\Sheets\ExpensesByMonthSheet;
use App\Services\HidroProjekt\Domain\Bookkeeping\ExpensesReportService;

class ExpensesByMonthExport implements WithMultipleSheets, Responsable
{
    use Exportable;
    
    private $month;
    private $data;

    private $filename;

    public function __construct(
        $month = NULL,
        )
    {
        $this->month = $month;
        $this->data = $this->getDataArray();
    }

    private function getDataArray(){
        return (new ExpensesReportService)->getDataForExportByMonth($this->month);
    }

     /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new ExpensesByMonthSheet($this->data);
        return $sheets;
    }
}
