<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkingDayLogModel;

class ReportingController extends Controller
{
    public function workLogsBook(){
        $logs = WorkingDayLogModel::where('construction_site_id', '!=', NULL)
            ->orderBy('created_at', 'DESC')
            ->with(
                'getWorkingDayRecord', 
                'getWorkingDayRecord.getConstructionSite',
                'getWorkingDayRecord.getUser.getWorker',
            )
            ->paginate(15);
        return view('hidro-projekt.REPORT.workLogsBook',[
            'logs' => $logs,
        ]);
    }

    public function expensesReport(){
        return view('hidro-projekt.REPORT.expensesReport');
    }
}
