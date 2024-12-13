<?php

namespace App\Services\HidroProjekt\Domain\Reports;

use App\Models\AttendanceModel;
use App\Models\AppParametersModel;
use App\Models\AttendanceCoOpModel;
use App\Models\WorkingDayRecordModel;
use App\Models\MaterialConsumptionModel;
use App\Models\MaterialConsumptionItemModel;
use App\Services\HidroProjekt\Domain\JobSite\JobSiteService;

class SumByJobSiteService
{
    private $jobSites;
    private $wdr;
    private $month;

    public function __construct(
        $jobSites = [],
        $month = 'all',
    )
    {
        $this->jobSites = $this->setJobSites($jobSites);
        $this->month = $month;
        $this->execute();
    }

    public function execute(){
        $workHourCostH= (float)AppParametersModel::where('param_name_srt', 'bwhv-h')->where('active', TRUE)->first()->value;
        $workHourCostC= (float)AppParametersModel::where('param_name_srt', 'bwh-c-o')->where('active', TRUE)->first()->value;
        $data=[];
        foreach ($this->jobSites as $jSite) {
            $jobSiteService = new JobSiteService($jSite->id);
            $data[$jSite->id] = [
                'name' => $jSite->name,
                'on_stock' => $jobSiteService->getMaterialsOnStock()->sum('cost'),
                'consumption' => $this->getJobSiteInfo($jSite->id)['consumption'],
                'work_hours_h' => $this->getJobSiteInfo($jSite->id)['work_hours_h'],
                'work_hours_c' => $this->getJobSiteInfo($jSite->id)['work_hours_c'],
            ];
        }
        foreach ($data as $key => $items) {
            $data[$key]['work_hours'] = $items['work_hours_h'] + $items['work_hours_c'];
            $data[$key]['work_hours_h_cost'] = $items['work_hours_h'] *$workHourCostH;
            $data[$key]['work_hours_c_cost'] = $items['work_hours_c'] *$workHourCostC;
            $data[$key]['work_hours'] = $items['work_hours_h'] + $items['work_hours_c'];
            $data[$key]['work_hours_cost'] = ($items['work_hours_h']*$workHourCostH) + ($items['work_hours_c']*$workHourCostC);
            $data[$key]['overall'] =($items['work_hours_h'] *$workHourCostH) + ($items['work_hours_c'] *$workHourCostC) + $items['consumption'];
        }
        return $data;
    }

    private function setJobSites($jobSites){
        $jobSiteService = new JobSiteService();
        if(!empty($jobSites)){
            return $jobSiteService->getJobSitesById($jobSites);
        }else{
            return $jobSiteService->getAllJobSites();
        };
    }

    private function getJobSiteInfo($jSiteId){
        $wdr = WorkingDayRecordModel::where('construction_site_id', $jSiteId);
        if($this->month != 'all'){
            if(is_array($this->month)){
                $wdr->whereMonth('date', $this->month);
            }
        }
        $matConsumption = MaterialConsumptionModel::whereIn('wdr_id',$wdr->pluck('id')->toArray())->pluck('id')->toArray();
        $matConsumptionItems = MaterialConsumptionItemModel::whereIn('mat_cons_id',$matConsumption)->get()->sum('cost');

        $attendance = AttendanceModel::whereIn('working_day_record_id', $wdr->pluck('id')->toArray())->get();
        $attendanceCoOp = AttendanceCoOpModel::whereIn('working_day_record_id', $wdr->pluck('id')->toArray())->get();
        return [
            'consumption' => $matConsumptionItems,
            'work_hours_h' => $attendance->sum('work_hours'),
            'work_hours_c' => $attendanceCoOp->sum('work_hours'),
        ];
    }
}
