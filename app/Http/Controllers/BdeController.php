<?php

namespace App\Http\Controllers;

use App\Models\WorkingDayRecordModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\HidroProjekt\Domain\WorkReport\DailyWorkReportService;

class BdeController extends Controller
{

    public function showBdeWorkReport($id){
        $dailyWorkReportService = new DailyWorkReportService();
        $dailyWorkReport = $dailyWorkReportService->findById($id);
        //if there is no entry for that id in db, redirect user to home page
        if(is_null($dailyWorkReport->getWdrObj())){
            return redirect()->route('home');
        }
        //redirect user to home page if the work report is not his
        if($dailyWorkReport->getWdrObj()->user_id != Auth::user()->id){
            return redirect()->route('home');
        }

        return view('hidro-projekt.bde-new.work-report',[
            'dailyWorkReport' => $dailyWorkReport->getWdrObj(),
        ]);
    }

    public function createNewReport(){
        if(Auth::user()){
            $dailyWorkReportService = new DailyWorkReportService();
            $newWorkReport = $dailyWorkReportService->createNewWorkReportItem(type: WorkingDayRecordModel::WORK_TYPE_HOME)->getWdrObj();
            return redirect()->route('showBdeWorkReport', $newWorkReport->id);
        }
        return;
    }
}
