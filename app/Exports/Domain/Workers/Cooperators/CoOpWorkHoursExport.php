<?php

namespace App\Exports\Domain\Workers\Cooperators;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Domain\Workers\Cooperators\Sheets\AttendanceListSheet;
use App\Exports\Domain\Workers\Cooperators\Sheets\AttendanceSummarizedSheet;

class CoOpWorkHoursExport implements WithMultipleSheets, Responsable
{
    use Exportable;
    
    private $list;
    private $summarized;

    private $filename;

    public function __construct(
        $list = NULL, 
        $summarized = NULL,
        )
    {
        $this->list = $list;
        $this->summarized = $summarized;
        $this->filename = 'test.xlsx';
    }

     /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new AttendanceSummarizedSheet($this->summarized);
        $sheets[] = new AttendanceListSheet($this->list);
        return $sheets;
    }
}
