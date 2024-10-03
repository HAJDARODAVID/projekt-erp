<?php

namespace App\Http\Controllers;

use App\Exports\Domain\Workers\Cooperators\CoOpWorkHoursExport;
use App\Services\HidroProjekt\Domain\Workers\Cooperators\CooperatorsExportWorkHoursService;

class Test2 extends Controller
{
    public function index(){
        try {
            $workHoursDto = new CooperatorsExportWorkHoursService(2,6,2024);
            return (new CoOpWorkHoursExport(
                $workHoursDto->getAttendanceList(),
                $workHoursDto->getSummarizedAttendance(),
            ))->download('download.xlsx');
            dd($workHoursDto);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
