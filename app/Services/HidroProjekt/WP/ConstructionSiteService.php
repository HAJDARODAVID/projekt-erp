<?php

namespace App\Services\HidroProjekt\WP;

use App\Models\ConstructionSiteModel;
use App\Models\WorkingDayRecordModel;

/**
 * Class ConstructionSiteService.
 */
class ConstructionSiteService
{

    public static function addNewConstructionSites($request):void { 
        ConstructionSiteModel::create($request);
    }

    public function updateConstructionSite($id,$data):void{
        ConstructionSiteModel::where('id', $id)->update($data);
    }

    public function getConstructionSite($id){
        return ConstructionSiteModel::where('id', $id)->first();
    }

    public function getHoursCumulatively($constSite){
        $workHours = 0;
        $wdrModel=WorkingDayRecordModel::where('construction_site_id', $constSite)->with('getAttendance')->get();

        foreach ($wdrModel as $workigDay) {
            foreach ($workigDay->getAttendance as $attendance) {
                $workHours += $attendance->work_hours;
            }
        }
        return $workHours;
    }

    public function getAllLogsForConstructionSiteString($constSite){
        $wdrModel=WorkingDayRecordModel::where('construction_site_id', $constSite)->with('getLogs', 'getUser.getWorker')->get();
        $stringLog="";
        //dd($wdrModel);
        foreach ($wdrModel as $workingDay) {
            foreach ($workingDay->getLogs as $logs) {
                $stringLog .= "[" . $workingDay->getUser->getWorker->firstName . " ";
                $stringLog .= $workingDay->getUser->getWorker->lastName . " - ";
                $stringLog .= $logs->created_at . "]\n";
                $stringLog .= $logs->log . "\n";
                $stringLog .= "\n";
            }
        }
       return $stringLog;
    }
}
