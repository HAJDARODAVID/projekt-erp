<?php

namespace App\Http\Controllers;

use App\Models\AttendanceModel;
use Illuminate\Http\Request;
use App\Models\StorageStockItem;
use App\Models\WorkingDayLogModel;
use Illuminate\Support\Facades\Auth;
use App\Models\ConstructionSiteModel;
use App\Models\ConstructionSiteConsumptionModel;
use App\Models\WorkingDayRecordModel;

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
        $user=Auth::user();
        if($user->id != 1 && $user->id != 2 && $user->id != 4){
            return redirect()->route('home');
        }
        return view('hidro-projekt.REPORT.expensesReport');
    }

    public function sumByJobSite(){
        $array=[];
        $jobSites = ConstructionSiteModel::where('status', ConstructionSiteModel::CONSTRUCTION_STATUS_ACTIVE)->pluck('name', 'id')->toArray();
        foreach ($jobSites as $key => $name) {
            $wdr = WorkingDayRecordModel::where('construction_site_id', $key)->pluck('id')->toArray();
            $attendance = AttendanceModel::whereIn('working_day_record_id', $wdr)->get()->sum('work_hours');
            $array[$key] = [
                'name' => $name,
                'onStock' => StorageStockItem::where('cons_id', $key)->get()->sum('cost'),
                'consumption' => ConstructionSiteConsumptionModel::where('const_site_id', $key)->get()->sum('amount'),
                'work_hours' => $attendance,
            ];
        }
        return view('hidro-projekt.REPORT.sum-by-job-sites',[
            'jobSites' => $array,
        ]);
    }
}
