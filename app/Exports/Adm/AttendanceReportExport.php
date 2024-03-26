<?php

namespace App\Exports\Adm;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use App\Exports\Adm\Sheets\SummaryReportSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Adm\Sheets\PerDayAndWorkerReportSheet;

class AttendanceReportExport implements WithMultipleSheets, Responsable
{
    use Exportable;
    
    protected $data;

    private $fileName = 'Attendance_Report_M.xlsx';

    public function __construct($data)
    {
        $this->data = $data;
        $this->fileName = 'Attendance_Report_M'.$this->data['month'].'.xlsx';
    }

     /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new SummaryReportSheet($this->data['summary']);
        $sheets[] = new PerDayAndWorkerReportSheet($this->data['per_day']);

        return $sheets;
    }
}
