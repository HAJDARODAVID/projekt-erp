<?php

namespace App\Exports\Hr;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Hr\Sheets\PayrollAccountingReportSheet;

class PayrollAccountingExport implements WithMultipleSheets, Responsable
{
    use Exportable;

    protected $data;
    private $fileName = 'Payroll accounting_M.xlsx';

    public function __construct($data, $month){
        $this->data = $data;
        $this->fileName = 'Payroll accounting_M'.$month.'.xlsx';

        $this->removeKeyFromArray();
    }

    /**
     * @return array
     */
    public function sheets(): array{
        $sheets=[];
        $sheets[] = new PayrollAccountingReportSheet($this->data);
        return $sheets;
    }

    protected function removeKeyFromArray():void{
        foreach ($this->data as $key => $value) {
            unset($this->data[$key]['is_worker']);
        }
        return;
    }
}
