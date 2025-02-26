<?php

namespace App\Services\HidroProjekt\Domain\WorkReport;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkingDayRecordModel;
use App\Exceptions\WorkDiaryException;
use App\Models\CompanyCarsModel;
use App\Models\ConstructionSiteModel;

class NewDailyWorkReport {

    private $param;

    private function __construct()
    {
        $this->param = [
            'user_id' => Auth::user()->id, 
            'construction_site_id' => NULL, 
            'car_id' => NULL, 
            'date' => date('Y-m-d'), 
            'work_description' => NULL, 
            'work_type' => WorkingDayRecordModel::WORK_TYPE_HOME];
    }

    public static function new()
    {
        return new self();
    }

    public function user($user){
        $this->param['user_id'] = $user;
        return $this;
    }

    public function jobSite($jobSite){
        $this->param['construction_site_id'] = $jobSite;
        return $this;
    }

    public function car($car){
        $this->param['car_id'] = $car;
        return $this;
    }

    public function date($date){
        if($date == NULL || $date == ""){
            $this->param['date'] = date('Y-m-d');
        }else{
            $this->param['date'] = $date;
        }
        return $this;
    }

    public function description($description){
        $this->param['work_description'] = $description;
        return $this;
    }

    public function type($type){
        if($type == NULL || $type == ""){
            $this->param['work_type'] = WorkingDayRecordModel::WORK_TYPE_HOME;
        }else{
            $this->param['work_type'] = $type;
        }
        return $this;
    }

    public function create(){
        /**
         * VALIDATION
         */
        //User
        if($this->param['user_id'] == NULL || $this->param['user_id'] == ""){
            $this->param['user_id'] = Auth::user()->id;
        }
        $user = User::where('id', $this->param['user_id'])->first();
        if($user->empty()){
            return throw new WorkDiaryException('user', $this->param['user_id']);
        }

        //Job site
        if($this->param['construction_site_id'] != NULL){
            $cs = ConstructionSiteModel::where('id', $this->param['construction_site_id'])->first();
            if($cs->empty()){
                return throw new WorkDiaryException('jobSite', $this->param['construction_site_id']);
            }
        }

        //Car
        if($this->param['car_id'] != NULL){
            $car = CompanyCarsModel::where('id', $this->param['car_id'])->first();
            if($car->empty()){
                return throw new WorkDiaryException('car', $this->param['car_id']);
            }
        }
    }

}