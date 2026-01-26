<?php

namespace App\Exports\Attendance;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Attendance\Sheets\MonthlyHoursReportSheet;

class MonthlyHoursReportExport implements WithMultipleSheets, Responsable
{
    use Exportable;

    /**
     * Data for exporting
     */
    protected $data;

    /**
     * Data for exporting
     * @var string;
     */
    protected string $fileName = 'monthly-hour';

    public function __construct($data)
    {
        $this->data = $data;
        $this->fileName = $this->fileName . '-' . date('U') . '.xlsx';
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        return [
            new MonthlyHoursReportSheet($this->data),
        ];
    }
}
