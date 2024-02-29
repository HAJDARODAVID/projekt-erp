<?php

namespace App\Services\HidroProjekt\WP;

use App\Models\AppParametersModel;
use App\Models\CompanyCarsModel;
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

    public function getWorkHoursCostPerDayAndConstSite($constSite){
        $workHourCost=[
            1 => (float)AppParametersModel::where('param_name_srt', 'bwhv-h')->where('active', TRUE)->first()->value,
            2 => (float)AppParametersModel::where('param_name_srt', 'bwhv-t')->where('active', TRUE)->first()->value,
        ];
        $wdrAll = WorkingDayRecordModel::where('construction_site_id', $constSite)
            ->with('getAttendance', 'getUser.getWorker')
            ->orderBy('date','desc')
            ->get();
        $array = [];
        $sumOfWorkerCost=0;
        foreach ($wdrAll as $wdr) {
            $workerHoursSum =0;
            foreach ($wdr->getAttendance as $att) {
                $workerHoursSum += $att->work_hours;
            }
            $array[$wdr->date][$wdr->id]=[
                'workerHoursSum' => $workerHoursSum,
                'workerHoursCost' => $workerHoursSum * $workHourCost[$wdr->work_type],
                'groupeLeader' => $wdr->getUser->getWorker->firstName . ' ' . $wdr->getUser->getWorker->lastName,
            ];
            $sumOfWorkerCost += $workerHoursSum * $workHourCost[$wdr->work_type];
        }
        $array['tableData'] = $array;
        $array['sumOfWorkerCost'] = $sumOfWorkerCost;
        return $array;
    }

    public function getWorkHoursCostPerDayAndConstSiteForCoOp($constSite){
        $workHourCost= (float)AppParametersModel::where('param_name_srt', 'bwh-c-o')->where('active', TRUE)->first()->value;
        $wdrAll = WorkingDayRecordModel::where('construction_site_id', $constSite)
            ->with('getAttendanceCoOp')
            ->orderBy('date','desc')
            ->get();
        $array = [];
        $sumOfWorkerCost=0;
        $sumOfWorkerHours=0;
        foreach ($wdrAll as $wdr) {
            $workerHoursSum =0;
            foreach ($wdr->getAttendanceCoOp as $att) {
                $workerHoursSum += $att->work_hours;
            }
            $sumOfWorkerCost += $workerHoursSum * $workHourCost;
            $sumOfWorkerHours += $workerHoursSum;
        }
        $array['sumOfWorkerCost'] = $sumOfWorkerCost;
        $array['sumOfWorkerHours'] = $sumOfWorkerHours;
        return $array;
    }

    public function getCarCostForConstSite($constSite){
        $workHourCost= (float)AppParametersModel::where('param_name_srt', 'bwcc')->where('active', TRUE)->first()->value;
        $wdrAll = WorkingDayRecordModel::where('construction_site_id', $constSite)
            ->with('getCarMileage')->get();
        $carMileage = 0;
        foreach ($wdrAll as $wdr) {
            foreach ($wdr->getCarMileage as $car) {
                if(!is_null($car->start_mileage) && !is_null($car->end_mileage)){
                    $carMileage += $car->end_mileage - $car->start_mileage;
                }
            }
        }
        $array['carCost'] = $carMileage * $workHourCost;
        return $array;
    }
}
