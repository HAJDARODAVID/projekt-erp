<?php

namespace App\Services\HidroProjekt\Domain\Workers\Cooperators;

use App\Exceptions\InvalidCooperatorException;
use App\Models\AttendanceCoOpModel;
use App\Models\ConstructionSiteModel;
use App\Models\CooperatorsModel;
use App\Models\CooperatorWorkersModel;
use App\Models\WorkingDayRecordModel;

class CooperatorsExportWorkHoursTransformer
{
    const FIXED_CONST = [
        532 => 'Čret',
    ];

    private $coop;
    private $month;
    private $year;
    private $isEmpty;
    private $data =[];

    public function __construct($coopId, $month, $year)
    {
        $this->coop = $this->setCoop($coopId);
        $this->month = $month;
        $this->year = $year;
        $this->execute();
    }

    public function getAttendanceList(){
        return $this->data['list'];
    }

    public function getSummarizedAttendance(){
        return $this->data['summarized_by_worker'];
    }

    public function isEmpty(){
        return $this->isEmpty;
    }

    private function execute(){
        $co_opWorkers=CooperatorWorkersModel::where('cooperator_id', $this->coop->id)->pluck('id')->toArray();
        $attendance = AttendanceCoOpModel::whereMonth('date', $this->month)
            ->whereYear('date', $this->year)
            ->whereIn('worker_id',$co_opWorkers)
            ->whereNotNull('work_hours');
        $this->isEmpty = $attendance->get()->isEmpty();
        $this->data['list'] = $this->setAttendanceList($attendance);
        $this->data['summarized_by_worker'] = $this->setSummarizedAttendance($attendance);
        return $this;
    }

    private function setAttendanceList($att){
        $data=[];
        $att = $att->orderBy('date', 'asc')->with('getWorkerInfo')->get();
        foreach($att as $item){
            $site = NULL;
            $wdr = WorkingDayRecordModel::where('id', $item->working_day_record_id)->get();
            if(!$wdr->isEmpty()){
                if(!is_null($wdr->first()->construction_site_id)){
                    $site = ConstructionSiteModel::where('id', $wdr->first()->construction_site_id)->first()->name;
                }
            }
            if(isset(self::FIXED_CONST[$item->working_day_record_id])){
                $site = self::FIXED_CONST[$item->working_day_record_id];
            }
            $date[]=[
                'Datum' => $item->date,
                '#' => $item->worker_id,
                'Ime' => $item->getWorkerInfo->firstName,
                'Prezime' => $item->getWorkerInfo->lastName,
                'Gradilište' => $site,
                'Radni sati' => $item->work_hours,
            ];
        }        
        return $date;
    }

    private function setSummarizedAttendance($att){
        $data=[];
        $workerObj=$att;
        //dd($att->get());
        $workers=$workerObj->get()->groupBy('worker_id');
        foreach ($workers as $worker) { 
            $date[]=[
                '#' => $worker->first()->worker_id,
                'Ime i prezime' =>$worker->first()->getWorkerInfo->firstName ." " . $worker->first()->getWorkerInfo->lastName,
                'OS' => $worker->sum('work_hours'),
            ];
        }
        return $date;
    }

    private function setCoop($coopId){
        //Check if cooperator is valid
        $coop=CooperatorsModel::where('id', $coopId)->get();
        if($coop->isEmpty()){
            return throw new InvalidCooperatorException($coopId);
        }
        return $coop->first();
    }

    
}