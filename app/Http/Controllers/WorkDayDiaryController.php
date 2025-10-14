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

    /**Define the module name */
    const MODULE = 'workday-diary';

    /**
     * Main page for the work day diaries.
     * Show table of work day diaries, and CRUD option.
     * 
     * @return view Livewire module  
     */
    public function workDayDiaries()
    {
        return $this->module();
        //TODO: delete this after production is IO
        //return view('hidro-projekt.WP.workDayDiaries');
    }

    public function showWorkDayDiary($id)
    {
        $wdr = WorkingDayRecordModel::where('id', $id)->with('getLogs')->first();
        $constSite = ConstructionSiteModel::where('id', $wdr->construction_site_id)->first();
        $car = CompanyCarsModel::where('id', $wdr->car_id)->first();
        $carMileage = CarMileageModel::where('wdr_id', $wdr->id)->first();
        $groupLeader = User::where('id', $wdr->user_id)->with('getWorker', 'getCooperator')->first();

        $stringLog = "";
        foreach ($wdr->getLogs as $logs) {
            $userName = "";
            if (!is_null($groupLeader->getWorker)) $userName = $groupLeader->getWorker->fullName;
            if (!is_null($groupLeader->getCooperator)) $userName = $groupLeader->getCooperator->fullName;
            $stringLog .= "[" .  $userName . " - ";
            $stringLog .= $logs->created_at . "]\n";
            $stringLog .= $logs->log . "\n";
            $stringLog .= "\n";
        }

        return view('hidro-projekt.WP.showWorkDayDiary', [
            'wdr' => $wdr,
            'groupLeader' => $groupLeader,
            'constSite' => $constSite,
            'car' => $car,
            'carMileage' => $carMileage,
            'stringLog' => $stringLog,
            'arst' => AttendanceModel::ABSENCE_REASON_SHT_TXT,
            'isPhone' => Agent::isPhone(),
        ]);
    }
}
