<?php

namespace App\Services\HidroProjekt\WP;

use App\Models\AppParametersModel;
use App\Models\CompanyCarsModel;
use App\Models\ConstructionSiteModel;
use App\Models\StorageStockItem;
use App\Models\WorkingDayRecordModel;
use App\Services\HidroProjekt\STG\StorageLocation;

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
        $wdrModel=WorkingDayRecordModel::where('construction_site_id', $constSite)->with('getLogs', 'getUser.getWorker', 'getUser.getCooperator')->get();
        $stringLog="";
        //dd($wdrModel);
        foreach ($wdrModel as $workingDay) {
            foreach ($workingDay->getLogs as $logs) {
                $userName = "";
                if(!is_null($workingDay->getUser->getWorker)) $userName =$workingDay->getUser->getWorker->fullName;
                if(!is_null($workingDay->getUser->getCooperator)) $userName =$workingDay->getUser->getCooperator->fullName;
                $stringLog .= "[" . $userName . " - ";
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
            4 => 0,
        ];
        $wdrAll = WorkingDayRecordModel::where('construction_site_id', $constSite)
            ->with('getAttendance', 'getUser.getWorker', 'getUser.getCooperator', 'getCarMileage')
            ->orderBy('date','desc')
            ->get();
        $array = [];
        $sumOfWorkerCost=0;
        foreach ($wdrAll as $wdr) {
            //get km for company car
            $carMileage=0;
            foreach ($wdr->getCarMileage as $carM) {
                $carMileage = $carM->end_mileage - $carM->start_mileage;
            }
            $workerHoursSum =0;
            foreach ($wdr->getAttendance as $att) {
                $workerHoursSum += $att->work_hours;
            }
            $groupeLeader = !is_null($wdr->getUser->getWorker) ? $wdr->getUser->getWorker->fullName : $wdr->getUser->getCooperator->fullName;
            $array[$wdr->date][$wdr->id]=[
                'workerHoursSum' => $workerHoursSum,
                'workerHoursCost' => $workerHoursSum * $workHourCost[$wdr->work_type],
                'groupeLeader' => $groupeLeader,
                'carMileage' => $carMileage,
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
        $tableData=[];
        foreach ($wdrAll as $wdr) {
            $workerHoursSum =0;
            foreach ($wdr->getAttendanceCoOp as $att) {
                $workerHoursSum += $att->work_hours;
                if(!isset($tableData[$wdr->id]['hours'])){
                    $tableData[$wdr->id]['hours'] = $att->work_hours;
                }else{
                    $tableData[$wdr->id]['hours'] = $tableData[$wdr->id]['hours']+$att->work_hours;
                }
                if(!isset($tableData[$wdr->id]['cost'])){
                    $tableData[$wdr->id]['cost'] = $att->work_hours * $workHourCost;
                }else{
                    $tableData[$wdr->id]['cost'] = $tableData[$wdr->id]['cost']+ ($att->work_hours* $workHourCost);
                }
            }
            $sumOfWorkerCost += $workerHoursSum * $workHourCost;
            $sumOfWorkerHours += $workerHoursSum;
        }
        $array['sumOfWorkerCost'] = $sumOfWorkerCost;
        $array['sumOfWorkerHours'] = $sumOfWorkerHours;
        $array['tableData'] = $tableData;
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

    public function getStockForConstructionSite($constSite){
        return StorageStockItem::where('str_loc', StorageLocation::CONSTRUCTION_SITE)
            ->where('cons_id', $constSite)->get();
    }
}
