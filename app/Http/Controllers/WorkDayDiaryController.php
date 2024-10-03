<?php

namespace App\Http\Controllers;

use App\Models\AttendanceCoOpModel;
use App\Models\AttendanceModel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CarMileageModel;
use App\Models\CompanyCarsModel;
use App\Models\ConstructionSiteModel;
use App\Models\WorkingDayRecordModel;
use Jenssegers\Agent\Facades\Agent;

class WorkDayDiaryController extends Controller
{
    
    public function workDayDiaries(){
        return view('hidro-projekt.WP.workDayDiaries');
    }

    public function showWorkDayDiary($id){
        $wdr = WorkingDayRecordModel::where('id', $id)->with('getLogs')->first();
        $constSite = ConstructionSiteModel::where('id', $wdr->construction_site_id)->first();
        $car=CompanyCarsModel::where('id', $wdr->car_id)->first();
        $carMileage = CarMileageModel::where('wdr_id', $wdr->id)->first();
        $groupLeader = User::where('id', $wdr->user_id)->with('getWorker')->first();
        $attendance = AttendanceModel::where('working_day_record_id', $wdr->id)->with('getWorkerInfo')->get();
        $attendanceCoOp = AttendanceCoOpModel::where('working_day_record_id', $wdr->id)->where('work_hours', '!=', NULL)->with('getWorkerInfo', 'getWorkerInfo.getCoOpInfo')->get();

        $stringLog="";
        foreach ($wdr->getLogs as $logs) {
            $stringLog .= "[" . $groupLeader->getWorker->firstName . " ";
            $stringLog .= $groupLeader->getWorker->lastName . " - ";
            $stringLog .= $logs->created_at . "]\n";
            $stringLog .= $logs->log . "\n";
            $stringLog .= "\n";
        }
        
        return view('hidro-projekt.WP.showWorkDayDiary',[
            'wdr' => $wdr,
            'groupLeader' => $groupLeader,
            'constSite' => $constSite,
            'car' => $car,
            'carMileage' => $carMileage,
            'stringLog' => $stringLog,
            'attendance' => $attendance,
            'attendanceCoOp'=> $attendanceCoOp,
            'arst' => AttendanceModel::ABSENCE_REASON_SHT_TXT,
            'isPhone' => Agent::isPhone(),
        ]);
    }
}
